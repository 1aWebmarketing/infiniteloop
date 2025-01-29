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
}" class="grid grid-cols-4 gap-4">
    <!-- Button Pills -->
    <button
        type="button"
        :class="selected === 'LOW' ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-700'"
        @click="setPriorityValue('LOW')"
        class="text-left rounded px-2 py-1 text-sm font-bold transition-all">
        <p class="text-xl">LOW</p>
        <span>Schönheits/Stylingfehler welche die Funktion des Systems nicht beeinflussen.</span>
    </button>

    <button
        type="button"
        :class="selected === 'MEDIUM' ? 'bg-yellow-500 text-white' : 'bg-yellow-100 text-yellow-700'"
        @click="setPriorityValue('MEDIUM')"
        class="text-left rounded px-2 py-1 text-sm font-bold transition-all">
        <p class="text-xl">MEDIUM</p>
        <span>Funktionen die für zukünftige Kunden oder Projektbenutzer wichtig werden können.</span>
    </button>

    <button
        type="button"
        :class="selected === 'HIGH' ? 'bg-orange-500 text-white' : 'bg-orange-100 text-orange-700'"
        @click="setPriorityValue('HIGH')"
        class="text-left rounded px-2 py-1 text-sm font-bold transition-all">
        <p class="text-xl">HIGH</p>
        <span>Sollte als erstes von den normalen ToDos bearbeitet werden da die Funktion schnellstmöglich gebraucht wird.</span>
    </button>

    <button
        type="button"
        :class="selected === 'CRITICAL' ? 'bg-red-500 text-white' : 'bg-red-100 text-red-700'"
        @click="setPriorityValue('CRITICAL')"
        class="text-left rounded px-2 py-1 text-sm font-bold transition-all">
        <p class="text-xl">CRITICAL</p>
        <span>Das System funktioniert nicht oder verhält sich in wichtigen Situationen komplett falsch.</span>
    </button>

    <!-- Hidden Input -->
    <input type="hidden" x-ref="hiddenPriorityInput" name="{{ $name }}" :value="selected">
</div>
