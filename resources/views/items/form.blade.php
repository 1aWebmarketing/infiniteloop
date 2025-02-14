<x-app-layout>

    <div class="mt-8 flex gap-4 items-center pb-4">
        <div class="bg-gray-100 rounded-full w-[100px] h-[100px] p-2 shadow border border-gray-400 overflow-hidden">
            <img src="{{ $item->project->getLogoUrl() }}">
        </div>
        <div>
            <a class="text-xs text-white drop-shadow hover:underline" href="{{ route('projects.show', ['project' => $item->project->id]) }}">Zurück zu {{ $item->project->name }}</a>
            <x-h1 class="text-white drop-shadow-lg">{{ $item->project->name }} - Feature vorschlagen</x-h1>
        </div>
    </div>

    <x-box>
        <form action="{{ $item->exists ? route('items.update', ['project' => $item->project_id, 'item' =>$item->uuid]) : route('items.store', ['project' => $item->project->id]) }}" method="POST">
            @csrf
            @if($item->exists)
                @method('PUT')
            @endif
            <input type="hidden" name="project_id" value="{{ $item->project->id }}" />

            <x-text-input name="title" class="w-full" placeholder="Titel" value="{{ old('title', $item->title) }}"/>
            <x-input-error :messages="$errors->get('title')" />

            <x-forms.tinymce-editor name="story">{{ old('story', $item->story) }}</x-forms.tinymce-editor>

            <x-h2 class="my-4">Typ</x-h2>
            <x-input-error :messages="$errors->get('type')" />
            <x-item-type name="type" :value="$item->type"/>

            <x-h2 class="my-4">Priorität</x-h2>
            <x-input-error :messages="$errors->get('priority')" />
            <x-item-priority name="priority" :value="$item->priority"/>

            <x-primary-button class="mt-4">Speichern</x-primary-button>
        </form>
    </x-box>

</x-app-layout>
