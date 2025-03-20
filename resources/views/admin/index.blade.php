<x-app-layout>
    <x-box class="mt-4">
        <x-h1>GitHub Connection</x-h1>

        @if(auth()->user()->github_token)
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-2" role="alert">
                <p class="font-bold">Connected</p>
                <p>GitHub connected successfully via OAuth</p>
            </div>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-800">
                    @foreach($repos as $id => $repo)
                        <tr class="bg-white border-b ">
                            <td class="px-6 py-4">{{ $id }}</td>
                            <td class="px-6 py-4">{{ $repo['owner'] }}</td>
                            <td class="px-6 py-4">{{ $repo['name'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        @else
            <x-primary-link-button href="{{ url('/admin/github') }}" class="btn btn-primary">Connect GitHub</x-primary-link-button>
        @endif
    </x-box>
</x-app-layout>
