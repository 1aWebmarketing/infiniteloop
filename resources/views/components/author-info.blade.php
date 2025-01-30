<div class="flex gap-2 items-center mb-2">
    @if($user)
        @php
        $hash = hash( 'sha256', strtolower( trim( $user->email . ' ' ) ) );
        $url = "https://gravatar.com/avatar/$hash";
        @endphp
        <img src="{{ $url }}" class="rounded-full w-[40px] h-[40px]">
    @endif
    <div>
        <p class="text-gray-600">{{ $user?->name ?? 'John Doe' }} &lt;{{ $user?->email }}&gt;</p>
        @if($date)
            <p class="text-gray-400 text-sm">{{ $date->format('d.m.Y H:i') }}</p>
        @endif
    </div>
</div>
