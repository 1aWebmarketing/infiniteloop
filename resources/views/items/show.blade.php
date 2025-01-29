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

    <x-box>
        <p>Von: {{ $item->user->name }} am {{ $item->created_at->format('d.m.Y H:i') }}</p>
        {!! $item->styledStory() !!}
    </x-box>

    @foreach($item->comments as $comment)
        <x-box>
            <p class="text-gray-400">{{ $comment->user->name }} am {{ $comment->created_at->format('d.m.Y H:i') }}</p>

            <div>
                {{ $comment->text }}
            </div>
        </x-box>
    @endforeach

    <x-h2>Kommentieren</x-h2>

    <x-box>
        <form action="{{ route('comments.store', ['item' => $item->id]) }}" method="POST">
            @csrf

            <x-textarea-group name="text"></x-textarea-group>

            <x-primary-button>Absenden</x-primary-button>
        </form>
    </x-box>

</x-app-layout>
