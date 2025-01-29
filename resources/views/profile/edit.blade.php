<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="space-y-6">
            <div class="bg-white border-b">
                <div class="max-w-xl pb-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white border-b">
                <div class="max-w-xl pb-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white border-b">
                <div class="max-w-xl pb-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
