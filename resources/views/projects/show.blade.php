<x-app-layout>

    <div class="flex gap-4 w-full items-center pb-6">
        <div class="bg-gray-800 rounded-full w-[100px] h-[100px] p-2 shadow border border-gray-700 overflow-hidden">
            <img src="{{ $project->getLogoUrl() }}">
        </div>
        <div>
            <a class="text-xs text-white drop-shadow hover:underline" href="{{ route('dashboard') }}">{{ __('projects.back_to_overview') }}</a>
            <x-h1 class="text-white drop-shadow-lg">{{ $project->name }}</x-h1>
        </div>
    </div>

    <x-box>
        <div class="flex gap-4 mb-4 border-b pb-4">
            {{--<x-primary-button>Alle anzeigen</x-primary-button>
            <x-primary-button>Abgeschlossene Items</x-primary-button> --}}
            <div class="flex-grow"></div>
            <x-primary-link-button href="{{ route('items.create', ['project' => $project->id]) }}">{{ __('projects.create_story') }}</x-primary-link-button>
        </div>


        @if( $activeItems->count() )
            <x-h2 class="text-white mb-2">{{ __('items.in_progress') }}</x-h2>
            @foreach($activeItems as $activeItem)
                <x-item-table class="bg-green-100/30 border-l-4 border-green-500" :project="$project" :item="$activeItem"/>
            @endforeach
        @endif

        @if( $createdItems->count() )
            <x-h2 class="text-white mt-4 mb-2">{{ __('items.open') }}</x-h2>
            @foreach($createdItems as $createdItem)
                <x-item-table class="bg-purple-100/30 border-l-4 border-purple-500" :project="$project" :item="$createdItem"/>
            @endforeach
        @endif

        @if( $doneItems->count() )
            <x-h2 class="text-white mt-4 mb-2">{{ __('items.done') }}</x-h2>
            @foreach($doneItems as $doneItem)
                <x-item-table class="bg-gray-100/30 border-l-4 border-gray-500" :project="$project" :item="$doneItem"/>
            @endforeach
        @endif
    </x-box>
</x-app-layout>
