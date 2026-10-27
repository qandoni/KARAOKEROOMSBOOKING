<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Редактировать бронь
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('booking.update', $booking) }}" class="space-y-4">
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Рум</label>
                        <select name="room_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" @selected($room->id == $booking->room_id)>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Начало</label>
                        <input type="datetime-local" name="starts_at" step="1800"
                               value="{{ $booking->starts_at->format('Y-m-d\TH:i') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Конец</label>
                        <input type="datetime-local" name="ends_at" step="1800"
                               value="{{ $booking->ends_at->format('Y-m-d\TH:i') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>
                    @foreach ($addons as $addon)
                        @php
                            $current = $booking->addons->firstWhere('id', $addon->id);
                            $qty = $current ? $current->pivot->quantity : 0;
                        @endphp
                        <div class="flex items-center gap-3 mb-2">
                            <input type="number" name="addons[{{ $addon->id }}]" min="0" value="{{ old('addons.'.$addon->id, $qty) }}"
                                   class="w-16 border-gray-300 rounded-md">
                            <span class="text-sm text-gray-700">{{ $addon->name }} — {{ $addon->price }} ₽</span>
                        </div>
                    @endforeach
                    <div class="flex gap-4">
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Сохранить
                        </button>
                        <a href="{{ route('booking.index') }}"
                           class="px-4 py-2 rounded-md text-gray-700 hover:underline">Отмена</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
