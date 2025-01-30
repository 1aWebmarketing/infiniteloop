<x-app-layout>

    <div class="mt-8 flex gap-4 items-center pb-6">
        <div class="bg-gray-100 rounded-full w-[100px] h-[100px] p-2 shadow border border-gray-400 overflow-hidden">
            <img src="{{ $project->getLogoUrl() }}">
        </div>
        <div>
            <a class="text-xs text-white drop-shadow hover:underline" href="{{ route('dashboard') }}">Zurück zur Projektübersicht</a>
            <x-h1 class="text-white drop-shadow-lg">{{ $project->name }}</x-h1>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-4">
        <div class="flex gap-4 mb-4 border-b pb-4">
            {{--<x-primary-button>Alle anzeigen</x-primary-button>
            <x-primary-button>Abgeschlossene Items</x-primary-button> --}}
            <div class="flex-grow"></div>
            <x-primary-link-button href="{{ route('items.create', ['project' => $project->id]) }}">✨ Feature vorschlagen ✨</x-primary-link-button>
        </div>


        @if( $activeItems->count() )
            <x-h2 class="mb-2">In Arbeit</x-h2>
            @foreach($activeItems as $activeItem)
                <x-item-table class="bg-green-100" :project="$project" :item="$activeItem"/>
            @endforeach
        @endif

        @if( $createdItems->count() )
            <x-h2 class="mt-4 mb-2">Warteschlange</x-h2>
            @foreach($createdItems as $createdItem)
                <x-item-table class="bg-purple-100" :project="$project" :item="$createdItem"/>
            @endforeach
        @endif

        @if( $doneItems->count() )
            <x-h2 class="mt-4 mb-2">Abgeschlossen</x-h2>
            @foreach($doneItems as $doneItem)
                <x-item-table class="bg-gray-100" :project="$project" :item="$doneItem"/>
            @endforeach
        @endif
    </div>
</x-app-layout>
