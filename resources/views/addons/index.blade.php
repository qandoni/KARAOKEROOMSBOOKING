<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Допуслуги
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <a href="{{ route('addons.create') }}"
                   class="inline-block mb-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Создать
                </a>

                @if ($addons->isEmpty())
                    <p class="text-gray-500">Допуслуг пока нет.</p>
                @else
                    <table class="w-full text-left">
                        <thead>
                        <tr class="border-b">
                            <th class="py-2">Название</th>
                            <th>Цена</th>
                            <th>Порядок</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($addons as $addon)
                            <tr class="border-b">
                                <td class="py-2">{{ $addon->name }}</td>
                                <td>{{ $addon->price }} ₽</td>
                                <td>{{ $addon->sort_order }}</td>
                                <td>
                                    @if ($addon->is_active)
                                        <span class="text-green-600">Активна</span>
                                    @else
                                        <span class="text-gray-400">Скрыта</span>
                                    @endif
                                </td>
                                <td class="space-x-2">
                                    <a href="{{ route('addons.edit', $addon) }}"
                                       class="text-indigo-600 hover:underline">Редактировать</a>

                                    @if ($addon->is_active)
                                        <form method="POST" action="{{ route('addons.destroy', $addon) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline"
                                                    onclick="return confirm('Скрыть допуслугу?')">Скрыть</button>
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
