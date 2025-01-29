<x-app-layout>

    <div class="mt-8 flex gap-4 items-center pb-4">
        <div>
            <x-h1 class="text-white drop-shadow-lg">Projekt anlegen</x-h1>
        </div>
    </div>

    <x-box>
        <form action="{{ $project->exists ? route('projects.update', $project->id) : route('projects.store', ['project' => $project->id]) }}" method="POST">
            @csrf
            @if($project->exists)
                @method('PUT')
            @endif

            <x-text-input name="name" class="w-full" placeholder="Name" />
            <x-input-error :messages="$errors->title->get('title')" />

            <x-forms.tinymce-editor name="description">{{ old('description', $project->description) }}</x-forms.tinymce-editor>

            <x-primary-button class="mt-4">Speichern</x-primary-button>
        </form>
    </x-box>

</x-app-layout>
