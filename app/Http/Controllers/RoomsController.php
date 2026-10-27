<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomsController extends Controller
{
    public function index():View
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create(): View
    {
        return view('rooms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        Room::create($data);

        return redirect()->route('rooms.index');
    }

    public function show(Room $room) : View
    {
        return view('rooms.show', ['room' => $room]);
    }

    public function edit(Room $room) : View
    {
        return view('rooms.edit', ['room' => $room]);
    }

    public function update(Request $request, Room $room): RedirectResponse
    {
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $room->update($data);

        return redirect()->route('rooms.index');
    }

    public function destroy(Room $room) : RedirectResponse
    {
        $room->delete();
        return redirect()->route('rooms.index');
    }
}
