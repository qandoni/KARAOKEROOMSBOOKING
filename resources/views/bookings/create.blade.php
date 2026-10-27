<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Новая бронь
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('booking.store') }}" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Рум</label>
                        <select name="room_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Начало</label>
                        <input type="datetime-local" name="starts_at" step="1800"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Конец</label>
                        <input type="datetime-local" name="ends_at" step ="1800"
                               class="mt-1 block w-full border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Допуслуги</label>
                        @foreach ($addons as $addon)
                            <div class="flex items-center gap-3 mb-2">
                                <input type="number" name="addons[{{ $addon->id }}]" min="0" value="0"
                                       class="w-16 border-gray-300 rounded-md">
                                <span class="text-sm text-gray-700">
                                    {{ $addon->name }} — {{ $addon->price }} ₽
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-md">
                        Забронировать
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
