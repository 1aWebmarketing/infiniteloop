<x-app-layout>
    <x-box class="mt-4">
        <x-h1>Github Verbinden</x-h1>

        @if(auth()->user()->github_token)
            <p>GitHub bereits verbunden</p>
        @else
            <x-primary-link-button href="{{ url('/admin/github') }}" class="btn btn-primary">Connect GitHub</x-primary-link-button>
        @endif
    </x-box>
</x-app-layout>
