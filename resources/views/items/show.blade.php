<x-app-layout>
    <div class="mt-8 flex gap-4 items-center pb-4">
        <div>
            <div class="bg-gray-100 rounded-full w-[100px] h-[100px] p-2 shadow border border-gray-400">
                <img src="{{ $item->project->getLogoUrl() }}">
            </div>
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
        <div class
        ="flex-grow"></div>

        <div class="flex-shrink-0">
            <livewire-item-status-selector :item="$item"/>
        </div>
    </div>

    <x-box>
        <div class="mb-2 pb-2 border-b flex justify-between items-center">
            <x-author-info :user="$item->user" :date="$item->created_at"/>

            @if($editable)
                <div class="flex gap-4 items-center">
                    <a href="{{ route('items.edit', ['project' => $item->project_id, 'item' => $item]) }}"><x-icons.edit width="1.5em"/></a>

                    <form action="{{ route('items.destroy', ['project' => $item->project_id, 'item' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-sm flex gap-2 items-center font-medium text-gray-600"><x-icons.delete width="1.5em" height="1.5em"/></button>
                    </form>
                </div>
            @endif
        </div>

        <div class="">
            {!! $item->styledStory() !!}
        </div>

    </x-box>

    @foreach($item->comments as $comment)
        <x-box>
            <x-author-info :user="$comment->user" :date="$comment->created_at"/>

            <div>
                {!! nl2br(addslashes($comment->text)) !!}
            </div>
        </x-box>
    @endforeach

    <x-h2 class="py-2 text-white">Kommentieren</x-h2>

    <x-box>
        <x-author-info :user="auth()->user()" :date="now()"/>

        <form action="{{ route('comments.store', ['item' => $item->id]) }}" method="POST">
            @csrf

            <x-textarea-group name="text"></x-textarea-group>

            <x-primary-button>Absenden</x-primary-button>
        </form>
    </x-box>

</x-app-layout>
