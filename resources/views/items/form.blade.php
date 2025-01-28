<x-app-layout>

    <div class="mt-8 flex gap-4 items-center pb-4">
        <div class="bg-gray-100 rounded-full w-[100px] h-[100px] p-2">
            <img src="{{ $item->project->getLogoUrl() }}">
        </div>
        <x-h1 class="">{{ $item->project->name }} - Feature vorschlagen</x-h1>
    </div>

    <div class="bg-white rounded-2xl shadow p-4">
        <form action="{{ $item->exists ? route('items.update', $item->id) : route('items.store', ['project' => $item->project->id]) }}" method="POST">
            @csrf
            @if($item->exists)
                @method('PUT')
            @endif
            <input type="hidden" name="project_id" value="{{ $item->project->id }}" />

            <x-text-input name="title" class="w-full" placeholder="Titel" />
            <x-input-error :messages="$errors->title->get('title')" />

            <x-forms.tinymce-editor name="story">{{ old('story', $item->story) }}</x-forms.tinymce-editor>

            <p class="mt-2">Typ</p>
            <x-item-type name="type" :value="$item->type"/>

            <p class="mt-2">Priorität</p>
            <x-item-priority name="priority" :value="$item->priority"/>

            <x-primary-button class="mt-2">Speichern</x-primary-button>
        </form>
    </div>

</x-app-layout>
