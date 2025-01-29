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
}" class="grid grid-cols-4 gap-4">
    <!-- Button Pills -->
    <button
        type="button"
        :class="selected === 'BUG' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-700'"
        @click="setTypeValue('BUG')"
        class="rounded px-2 py-1 text-sm font-bold transition-all">
        <p class="text-xl">BUG</p>
        <span>Eine fehlerhafte Funktion im Projekt</span>
    </button>

    <button
        type="button"
        :class="selected === 'FEATURE' ? 'bg-green-500 text-white' : 'bg-green-100 text-green-700'"
        @click="setTypeValue('FEATURE')"
        class="rounded px-2 py-1 text-sm font-bold transition-all">
        <p class="text-xl">FEATURE</p>
        <span>Eine neue Funktion für das Projekt</span>
    </button>

    <button
        type="button"
        :class="selected === 'TASK' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-700'"
        @click="setTypeValue('TASK')"
        class="rounded px-2 py-1 text-sm font-bold transition-all">
        <p class="text-xl">TASK</p>
        <span>Generelle Aufgabe für das System die weder einen Fehler löst noch ein neues Feature hinzufügt.</span>
    </button>

    <!-- Hidden Input -->
    <input type="hidden" x-ref="hiddenTypeInput" name="{{ $name }}" :value="selected">
</div>
