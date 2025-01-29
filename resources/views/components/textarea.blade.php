@props([
    'name' => '',
])
<textarea name="{{ $name }}" class="w-full h-28 rounded-xl border-2 border-gray-200">{{ $slot }}</textarea>
