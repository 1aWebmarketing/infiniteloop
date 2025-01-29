<x-app-layout>

    <div class="mt-8 flex gap-4 items-center pb-4">
        <div class="bg-gray-100 rounded-full w-[100px] h-[100px] p-2 shadow border border-gray-400">
            <img src="{{ $item->project->getLogoUrl() }}">
        </div>
        <div>
            <a class="text-white text-xs drop-shadow hover:underline" href="{{ route('projects.show', ['project' => $item->project->id]) }}">Zurück zu {{ $item->project->name }}</a>
            <x-h1 class="text-white drop-shadow-lg">{{ $item->title }}</x-h1>

            <ul class="flex gap-4 mt-2">
                <li>{!! $item->statusPillHtml() !!}</li>
                <li>{!! $item->typePillHtml() !!}</li>
                <li>{!! $item->priorityPillHtml() !!}</li>
            </ul>
        </div>
        <div class="flex-grow"></div>

        <div>
            <livewire-item-status-selector :item="$item"/>
        </div>
    </div>

    <x-box>
        <div class="mb-2 pb-2 border-b">
            <p class="text-sm">Von: {{ $item->user->name }} am {{ $item->created_at->format('d.m.Y H:i') }}</p>
        </div>

        <div class="">
            {!! $item->styledStory() !!}
        </div>
    </x-box>

    @foreach($item->comments as $comment)
        <x-box>
            <p class="text-gray-400">{{ $comment->user->name }} &lt;{{ $comment->user->email }}&gt; am {{ $comment->created_at->format('d.m.Y H:i') }}</p>

            <div>
                {{ $comment->text }}
            </div>
        </x-box>
    @endforeach

    <x-h2 class="py-2 text-white">Kommentieren</x-h2>

    <x-box>
        <form action="{{ route('comments.store', ['item' => $item->id]) }}" method="POST">
            @csrf

            <x-textarea-group name="text"></x-textarea-group>

            <x-primary-button>Absenden</x-primary-button>
        </form>
    </x-box>

</x-app-layout>
