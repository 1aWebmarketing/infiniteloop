<div>
    <x-section-border/>

    <!-- Add Team Member -->
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <x-section-title>
                <x-slot name="title">GitHub Connection</x-slot>
                <x-slot name="description">Connect your GitHub Repos to infiniteloop.</x-slot>
            </x-section-title>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white dark:bg-gray-800 sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                    <x-primary-button wire:click="connectGitHub">Connect to GitHub</x-primary-button>
                </div>
            </div>
        </div>
    </div>

</div>
