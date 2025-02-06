<x-app-layout>

    <div class="mt-8 flex gap-4 items-center pb-4">
        <div>
            <x-h1 class="text-white">Projektübersicht</x-h1>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        @foreach($projects as $project)
            <x-box>
                <div class="flex justify-between">
                    <a class="flex gap-4 items-center" href="{{ route('projects.show', ['project' => $project->id]) }}">
                        <div class="bg-gray-100 rounded-full w-[50px] h-[50px] p-2">
                            <img src="{{ $project->getLogoUrl() }}">
                        </div>
                        <p class="text-2xl font-bold">{{ $project->name }}</p>
                    </a>

                    @can('edit-project', $project)
                        <ul class="flex gap-4">
                            <li><a href="{{ route('projects.edit', ['project' => $project->id]) }}">Editieren</a></li>
                            <li>
                                <form method="POST" action="{{ route('projects.destroy', ['project' => $project->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button>Löschen</button>
                                </form>
                            </li>
                        </ul>
                    @endcan
                </div>

                <p class="text-gray-400 my-2">{{ $project->description }}</p>

                <ul class="flex gap-4 mb-2">
                    <li class="flex gap-2">
                        <x-icons.items width="1em"/>
                        {{ $project->items_count }}
                    </li>
                    <li class="flex gap-2">
                        <x-icons.comments width="1em"/>
                        {{ $project->total_comments }}
                    </li>

                    <li class="flex-grow"></li>

                    <li class="rounded font-bold overflow-hidden flex group">
                        <div class="px-2 py-1 text-sm bg-green-100 text-green-600 flex gap-1">
                            <span class="group-hover:block hidden">In Progress</span>
                            <span class="group-hover:hidden">P</span>
                            {{ $project->activeItemsCount }}
                        </div>
                        <div class="px-2 py-1 text-sm bg-purple-100 text-purple-600 flex gap-1">
                            <span class="group-hover:block hidden">Open</span>
                            <span class="group-hover:hidden">O</span>
                            {{ $project->createdItemsCount }}
                        </div>
                        <div class="px-2 py-1 text-sm bg-gray-100 text-gray-600 flex gap-1">
                            <span class="group-hover:block hidden">Done</span>
                            <span class="group-hover:hidden">D</span>
                            {{ $project->doneItemsCount }}
                        </div>
                    </li>
                </ul>

                <x-primary-link-button :href="route('projects.show', ['project' => $project->id])">Auswählen</x-primary-link-button>
            </x-box>
        @endforeach
    </div>
</x-app-layout>
