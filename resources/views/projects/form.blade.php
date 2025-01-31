<x-app-layout>

    <div class="mt-8 flex gap-4 items-center pb-4">
        <div>
            <x-h1 class="text-white drop-shadow-lg">Projekt anlegen</x-h1>
        </div>
    </div>

    <x-box>
        <form action="{{ $project->exists ? route('projects.update', $project->id) : route('projects.store', ['project' => $project->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if($project->exists)
                @method('PUT')
            @endif

            <x-text-input name="name" class="w-full" value="{{ old('name', $project->name) }}" placeholder="Name" />
            <x-input-error :messages="$errors->get('name')" />

            <x-h2 class="my-4">Logo</x-h2>
            @if( $project->logo )
                <div class="bg-gray-100 mb-2 rounded-full w-[100px] h-[100px] p-2 shadow border border-gray-400 overflow-hidden">
                    <img src="{{ $project->getLogoUrl() }}">
                </div>
            @endif

            <input type="file" name="file">

            <x-h2 class="my-4">Projektbeschreibung</x-h2>
            <x-input-error :messages="$errors->get('description')" />
            <x-textarea name="description">{{ old('description', $project->description) }}</x-textarea>

            <x-h2 class="my-4">Story Format</x-h2>
            <x-input-error :messages="$errors->get('template')" />
            <x-forms.tinymce-editor name="template">{{ old('template', $project->template) }}</x-forms.tinymce-editor>

            <x-primary-button class="mt-4">Speichern</x-primary-button>
        </form>
    </x-box>

</x-app-layout>
