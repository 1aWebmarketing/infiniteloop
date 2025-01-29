<x-app-layout>
    <div class="mt-8 flex gap-4 items-center pb-4">
        <div>
            <x-h1 class="">Profil</x-h1>
        </div>
    </div>

    <div>
        <div class="space-y-6">
            <x-box>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </x-box>

            <x-box>
                    @include('profile.partials.update-password-form')
            </x-box>

            <x-box>
                @include('profile.partials.delete-user-form')
            </x-box>
        </div>
    </div>
</x-app-layout>
