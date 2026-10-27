<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Мои брони
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('booking.create') }}"
                   class="inline-block mb-4 bg-indigo-600 text-white px-4 py-2 rounded-md">
                    Новая бронь
                </a>

                @if ($bookings->isEmpty())
                    <p class="text-gray-500">Броней пока нет.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                        <tr class="border-b">
                            <th class="py-2">Рум</th>
                            <th>Начало</th>
                            <th>Конец</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($bookings as $booking)
                            <tr class="border-b {{ $booking->status === 'cancelled' ? 'text-gray-400' : '' }}">
                                <td class="py-2">{{ $booking->room->name }}</td>
                                <td>{{ $booking->starts_at->format('d.m.Y H:i') }}</td>
                                <td>{{ $booking->ends_at->format('d.m.Y H:i') }}</td>
                                <td>{{ number_format($booking->total_price, 0, '.', ' ') }} ₽</td>
                                <td>{{ $booking->status }}</td>
                                <td>
                                    @foreach ($booking->addons as $addon)
                                        <div class="text-sm">{{ $addon->name }} × {{ $addon->pivot->quantity }}</div>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($booking->status === 'active')
                                        <form method="GET" action="{{ route('booking.edit', $booking) }}">
                                            @method('PATCH')
                                            <button class="text-indigo-600">Редактировать</button>
                                        </form>
                                        <form method="POST" action="{{ route('booking.destroy', $booking) }}">
                                            @method('DELETE')
                                            <button class="text-red-600">Отменить</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
