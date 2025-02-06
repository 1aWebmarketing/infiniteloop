<div {{ $attributes->merge(['class' => 'flex gap-4 mb-2 border-b pb-2 px-2 pt-2']) }}>
    <div class="bg-gray-500/10 rounded p-2 flex flex-col gap-2 justify-center items-center">
        <form action="{{ route('items.upvote', ['item' => $item->id]) }}" method="POST">
            @csrf
            <button class="hover:cursor-pointer">
                @if( canUpvote(auth()->user(), $item) )
                    <x-icons.up-arrow width="25px" height="25px" />
                @else
                    <x-icons.up-arrow-green width="25px" height="25px" />
                @endif
            </button>
        </form>
        <p class="font-bold text-xl">{{ $item->voting }}</p>
    </div>

    <div class="flex-grow py-2">
        <p class="text-xl font-bold mb-2"><a href="{{ route('items.show', ['project' => $project->id, 'item' => $item->id]) }}">{{ $item->title }} <span class="text-xs text-gray-500">{{ formatDateTime($item->created_at) }}</span></a></p>
        <ul class="flex gap-4 items-center">
            <li>{!! $item->typePillHtml() !!}</li>
            <li>{!! $item->priorityPillHtml() !!}</li>
        </ul>
    </div>

    <div class="flex-shrink-0 pt-2">
        <p class="flex gap-1 items-center"><x-icons.comments width="1em"/> {{ $item->comments()->count() }}</p>
    </div>
</div>
