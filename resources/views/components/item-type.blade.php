@props([
    'name' => '',
    'value' => '',
])
<div x-data="{
    selected: '{{ $value }}' || '',
    setTypeValue(value) {
        this.selected = value;
        this.$refs.hiddenTypeInput.value = value;
    }
}" class="flex flex-col gap-4">
    <!-- Button Pills -->
    <button
        type="button"
        :class="selected === 'BUG' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-700 opacity-70'"
        @click="setTypeValue('BUG')"
        class="rounded px-2 py-2 text-sm font-bold transition-all">
        <p class="text-xl">{{ __('items.bug') }}</p>
        <span>{{ __('items.bug_description') }}</span>
    </button>

    <button
        type="button"
        :class="selected === 'FEATURE' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-700 opacity-70'"
        @click="setTypeValue('FEATURE')"
        class="rounded px-2 py-2 text-sm font-bold transition-all">
        <p class="text-xl">{{ __('items.feature') }}</p>
        <span>{{ __('items.feature_description') }}</span>
    </button>

    <button
        type="button"
        :class="selected === 'TASK' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-700 opacity-70'"
        @click="setTypeValue('TASK')"
        class="rounded px-2 py-2 text-sm font-bold transition-all">
        <p class="text-xl">{{ __('items.task') }}</p>
        <span>{{ __('items.task_description') }}</span>
    </button>

    <!-- Hidden Input -->
    <input type="hidden" x-ref="hiddenTypeInput" name="{{ $name }}" :value="selected">
</div>
