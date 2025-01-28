@props([
    'name' => '',
    'value' => '',
])
<div x-data="{
    selected: '{{ $value }}' || '',
    setPriorityValue(value) {
        this.selected = value;
        this.$refs.hiddenPriorityInput.value = value;
    }
}" class="flex items-center space-x-2">
    <!-- Button Pills -->
    <button
        type="button"
        :class="selected === 'LOW' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-700'"
        @click="setPriorityValue('LOW')"
        class="rounded px-2 py-1 text-sm font-bold transition-all">
        LOW
    </button>

    <button
        type="button"
        :class="selected === 'MEDIUM' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-700'"
        @click="setPriorityValue('MEDIUM')"
        class="rounded px-2 py-1 text-sm font-bold transition-all">
        MEDIUM
    </button>

    <button
        type="button"
        :class="selected === 'HIGH' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-700'"
        @click="setPriorityValue('HIGH')"
        class="rounded px-2 py-1 text-sm font-bold transition-all">
        HIGH
    </button>

    <!-- Hidden Input -->
    <input type="hidden" x-ref="hiddenPriorityInput" name="{{ $name }}" :value="selected">
</div>
