<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Караоке-румы
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('rooms.create') }}"
                   class="inline-block mb-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Создать
                </a>

                @if ($rooms->isEmpty())
                    <p class="text-gray-500">Румов пока нет.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                        <tr class="border-b">
                            <th class="py-2">Название</th>
                            <th>Цена/ч</th>
                            <th>Мин. ч.</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($rooms as $room)
                            <tr class="border-b">
                                <td class="py-2">{{ $room->name }}</td>
                                <td>{{ $room->price_per_hour }} ₽</td>
                                <td>{{ $room->min_hours }}</td>
                                <td>
                                    @if ($room->is_active)
                                        <span class="text-green-600">Активен</span>
                                    @else
                                        <span class="text-gray-400">Скрыт</span>
                                    @endif
                                </td>
                                <td class="space-x-2">
                                    <a href="{{ route('rooms.edit', $room) }}"
                                       class="text-indigo-600 hover:underline">Редактировать</a>

                                    <form method="POST" action="{{ route('rooms.destroy', $room) }}" style="display:inline">
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline"
                                                onclick="return confirm('Удалить рум?')">Удалить</button>
                                    </form>
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
