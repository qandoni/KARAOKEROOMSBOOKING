<div>
    <label class="block text-sm font-medium text-gray-700">Название</label>
    <input name="name" value="{{ old('name', $room?->name) }}"
           class="mt-1 block w-full border-gray-300 rounded-md">
    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Описание</label>
    <textarea name="description" rows="3"
              class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $room?->description) }}</textarea>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Вместимость</label>
    <input type="number" name="capacity" value="{{ old('capacity', $room?->capacity) }}"
           class="mt-1 block w-full border-gray-300 rounded-md">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Цена за час</label>
    <input type="number" step="0.01" name="price_per_hour" value="{{ old('price_per_hour', $room?->price_per_hour) }}"
           class="mt-1 block w-full border-gray-300 rounded-md">
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Минимум часов</label>
    <input type="number" name="min_hours" value="{{ old('min_hours', $room?->min_hours ?? 1) }}"
           class="mt-1 block w-full border-gray-300 rounded-md">
</div>

<div class="flex items-center gap-2">
    <input type="checkbox" name="is_active" id="is_active"
           {{ old('is_active', $room?->is_active ?? true) ? 'checked' : '' }}
           class="rounded border-gray-300">
    <label for="is_active" class="text-sm text-gray-700">Активен</label>
</div>

<button class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
    Сохранить
</button>
