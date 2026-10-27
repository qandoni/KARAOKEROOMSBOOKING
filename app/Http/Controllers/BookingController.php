<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(): View
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with(['room', 'addons'])
            ->get()
            ->sortBy([
                ['status', 'asc'],
                ['starts_at', 'desc'],
            ]);

        return view('bookings.index', ['bookings' => $bookings]);
    }
    public function create(): View{
        $rooms = Room::where("is_active", true)->get();
        $addons = Addon::where("is_active", true)->orderBy('sort_order')->get();
        return view('bookings.create', ['rooms' => $rooms, 'addons' => $addons]);
    }

    public function store(Request $request): RedirectResponse
    {
        $startsAt = Carbon::parse($request->starts_at);
        $endsAt = Carbon::parse($request->ends_at);

        if ($endsAt <= $startsAt) {
            return back()->withErrors(['ends_at' => 'Конец должен быть позже начала.'])->withInput();
        }

        if ($startsAt->minute % 30 !== 0 || $endsAt->minute % 30 !== 0) {
            return back()->withErrors(['starts_at' => 'Время должно быть ЧЧ:00 или ЧЧ:30.'])->withInput();
        }

        $room = Room::findOrFail($request->room_id);
        $hours = $startsAt->diffInMinutes($endsAt) / 60;
        $total = $hours * $room->price_per_hour;

        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->room_id = $room->id;
        $booking->starts_at = $startsAt;
        $booking->ends_at = $endsAt;
        $booking->status = 'active';
        $booking->total_price = $total;
        $booking->save();

        if ($request->has('addons')) {
            foreach ($request->addons as $addonId => $quantity) {
                if ($quantity < 1) {
                    continue;
                }
                $addon = Addon::find($addonId);
                $booking->addons()->attach($addonId, [
                    'quantity' => $quantity,
                    'price_at_booking' => $addon->price,
                ]);
                $total += $addon->price * $quantity;
            }
        }

        $booking->total_price = $total;
        $booking->save();

        return redirect()->route('booking.index');
    }
    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->route('booking.index');
    }

    public function edit(Booking $booking): View
    {
        $rooms = Room::where('is_active', true)->get();
        $addons = Addon::where('is_active', true)->orderBy('sort_order')->get();

        return view('bookings.edit', compact('booking', 'rooms', 'addons'));
    }

    public function update(Request $request, Booking $booking): RedirectResponse
    {
        $booking->room_id = $request->room_id;
        $booking->starts_at = $request->starts_at;
        $booking->ends_at = $request->ends_at;

        $syncData =[];
        if ($request->has('addons')){
            foreach ($request->addons as $addonId => $quantity) {
                if ($quantity < 1) {
                    continue;
                }
                $addon = Addon::find($addonId);
                $syncData[$addonId] = [
                    'quantity' => $quantity,
                    'price_at_booking' => $addon->price,
                ];
            }
        }
        $booking->addons()->sync($syncData);

        $room = Room::find($request->room_id);
        $hours = Carbon::parse($request->starts_at)
            ->diffInHours(Carbon::parse($request->ends_at));
        $total = $hours * $room->price_per_hour;
        foreach ($syncData as $addonId=>$data) {
            $total += Addon::find($addonId)->price * $data['quantity'];
        }
        $booking ->total_price=$total;
        $booking->save();

        return redirect()->route('booking.index');
    }
}
