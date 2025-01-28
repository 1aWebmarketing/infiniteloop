<x-app-layout>

    <div class="mt-8 flex gap-4 items-center pb-4">
        <div class="bg-gray-100 rounded-full w-[100px] h-[100px] p-2">
            <img src="{{ $item->project->getLogoUrl() }}">
        </div>
        <div>
            <a class="text-xs hover:underline" href="{{ route('projects.show', ['project' => $item->project->id]) }}">Zurück zu {{ $item->project->name }}</a>
            <x-h1 class="">{{ $item->title }}</x-h1>

            <ul class="flex gap-4 mt-2">
                <li>{!! $item->typePillHtml() !!}</li>
                <li>{!! $item->priorityPillHtml() !!}</li>
            </ul>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-4">
        <p>Von: {{ $item->user->name }} am {{ $item->created_at->format('d.m.Y H:i') }}</p>
        {!! $item->styledStory() !!}

    </div>
</x-app-layout>
