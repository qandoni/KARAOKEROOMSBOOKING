@csrf

<div>
    <label class="block text-sm font-medium text-gray-700">Название</label>
    <input name="name" value="{{ old('name', $addon?->name) }}"
           class="mt-1 block w-full border-gray-300 rounded-md">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Описание</label>
    <textarea name="description" rows="3"
              class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $addon?->description) }}</textarea>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Цена</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $addon?->price) }}"
           class="mt-1 block w-full border-gray-300 rounded-md">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Порядок вывода</label>
    <input type="number" name="sort_order" value="{{ old('sort_order', $addon?->sort_order ?? 0) }}"
           class="mt-1 block w-full border-gray-300 rounded-md">
    <p class="text-xs text-gray-500 mt-1">Меньше — выше в списке</p>
</div>

<div class="flex items-center gap-2">
    <input type="checkbox" name="is_active" id="is_active"
           {{ old('is_active', $addon?->is_active ?? true) ? 'checked' : '' }}
           class="rounded border-gray-300">
    <label for="is_active" class="text-sm text-gray-700">Активна</label>
</div>

<button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
    Сохранить
</button>
