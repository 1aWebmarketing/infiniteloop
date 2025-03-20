<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="grid grid-cols-2 gap-4">
        @foreach($projects as $project)
            <x-box>
                <div class="flex justify-between">
                    <a class="flex gap-4 items-center" href="{{ route('projects.show', ['project' => $project->id]) }}">
                        <div class="rounded-full w-[50px] h-[50px]">
                            <img src="{{ $project->getLogoUrl() }}">
                        </div>
                        <p class="text-2xl font-bold text-white">{{ $project->name }}</p>
                    </a>

                    @can('edit-project', $project)
                        <ul class="flex gap-4">
                            <li>
                                <a href="{{ route('projects.edit', ['project' => $project->id]) }}">
                                    <x-icons.edit class="invert" width="1.0em"/>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('projects.destroy', ['project' => $project->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button>
                                        <x-icons.delete class="invert" width="1.0em"/>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @endcan
                </div>

                <p class="text-gray-400 my-2">{{ $project->description }}</p>

                <ul class="flex gap-4 mb-2">
                    <li class="flex gap-2 text-white">
                        <x-icons.items width="1em" class="invert"/>
                        {{ $project->items_count }}
                    </li>
                    <li class="flex gap-2 text-white">
                        <x-icons.comments width="1em" class="invert"/>
                        {{ $project->total_comments }}
                    </li>

                    <li class="flex-grow"></li>

                    <li class="rounded font-bold overflow-hidden flex group">
                        <div class="px-2 py-1 text-sm bg-green-100 text-green-600 flex gap-1">
                            <span class="group-hover:block hidden">{{ __('items.in_progress') }}</span>
                            <span class="group-hover:hidden">{{ __('items.in_progress_abbr') }}</span>
                            {{ $project->activeItemsCount }}
                        </div>
                        <div class="px-2 py-1 text-sm bg-purple-100 text-purple-600 flex gap-1">
                            <span class="group-hover:block hidden">{{ __('items.open') }}</span>
                            <span class="group-hover:hidden">{{ __('items.open_abbr') }}</span>
                            {{ $project->createdItemsCount }}
                        </div>
                        <div class="px-2 py-1 text-sm bg-gray-100 text-gray-600 flex gap-1">
                            <span class="group-hover:block hidden">{{ __('items.done') }}</span>
                            <span class="group-hover:hidden">{{ __('items.done_abbr') }}</span>
                            {{ $project->doneItemsCount }}
                        </div>
                    </li>
                </ul>

                <x-primary-link-button :href="route('projects.show', ['project' => $project->id])">{{ __('projects.show') }}</x-primary-link-button>
            </x-box>
        @endforeach
    </div>
</x-app-layout>
