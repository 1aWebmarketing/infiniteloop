<div {{ $attributes->merge(['class' => 'flex gap-4 mb-2 pb-2 px-2 pt-2 text-white']) }}>
    <div class="bg-gray-500/10 rounded p-2 flex flex-col gap-2 justify-center items-center">
        <form action="{{ route('items.upvote', $item->id) }}" method="POST">
            @csrf
            <button class="hover:cursor-pointer">
                @if( canUpvote(auth()->user(), $item) )
                    <x-icons.up-arrow width="25px" height="25px" class="invert"/>
                @else
                    <x-icons.up-arrow-green width="25px" height="25px"/>
                @endif
            </button>
        </form>
        <p class="font-bold text-xl">{{ $item->voting }}</p>
    </div>

    <div class="flex-grow py-2">
        <p class="text-xl font-bold"><a href="{{ route('items.show', $item->id) }}">{{ $item->title }}</a></p>
        <p class="text-xs text-gray-200 mb-2">{{ formatDateTime($item->created_at) }} - {{ $item->user->name }}</p>
        <ul class="flex gap-4 items-center">
            <li>{!! $item->typePillHtml() !!}</li>
            <li>{!! $item->priorityPillHtml() !!}</li>
        </ul>
    </div>

    <div class="flex-shrink-0 pt-2">
        <p class="flex gap-1 items-center">
            <x-icons.comments width="1em"/> {{ $item->comments()->count() }}</p>
    </div>
</div>
