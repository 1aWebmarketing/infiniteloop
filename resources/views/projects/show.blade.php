<x-app-layout>

    <div class="mt-8 flex gap-4 items-center pb-6">
        <div class="bg-gray-100 rounded-full w-[100px] h-[100px] p-2">
            <img src="{{ $project->getLogoUrl() }}">
        </div>
        <div>
            <a class="text-xs hover:underline" href="{{ route('dashboard') }}">Zurück zur Projektübersicht</a>
            <x-h1 class="">{{ $project->name }}</x-h1>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-4">
        <div class="flex gap-4 mb-4 border-b pb-4">
            <x-primary-button>Alle anzeigen</x-primary-button>
            <x-primary-button>Abgeschlossene Items</x-primary-button>
            <div class="flex-grow"></div>
            <x-primary-link-button href="{{ route('items.create', ['project' => $project->id]) }}">✨ Feature vorschlagen ✨</x-primary-link-button>
        </div>

        @foreach($project->items as $item)
            <div class="flex gap-4 mb-2 border-b pb-2">
                <div class="bg-gray-100 rounded p-2 flex flex-col gap-2 justify-center items-center">
                    <button class="hover:cursor-pointer"><x-icons.up-arrow width="25px" height="25px" /></button>
                    <p class="font-bold text-xl">{{ $item->voting }}</p>
                </div>

                <div class="flex-grow py-2">
                    <p class="text-xl font-bold mb-2"><a href="{{ route('items.show', ['project' => $project->id, 'item' => $item->id]) }}">{{ $item->title }}</a></p>
                    <ul class="flex gap-4 items-center">
                        <li>{!! $item->typePillHtml() !!}</li>
                        <li>{!! $item->priorityPillHtml() !!}</li>
                        <li class="text-gray-500 text-sm">{{ $item->created_at?->format('d.m.Y H:i') }}</li>
                    </ul>
                </div>
                <div class="pt-2">
                    <p>0 Kommentare</p>
                    <a href="{{ route('items.show', ['project' => $project->id, 'item' => $item->id]) }}" class="text-sm flex gap-2 items-center font-medium text-gray-600">Details ansehen <x-icons.right-arrow width="1em" height="1em"/></a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
