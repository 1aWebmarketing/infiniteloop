<x-app-layout>
    <div class="mt-8 flex gap-4 items-center pb-4">
        <div>
            <x-h1 class="text-white">Changelog</x-h1>
        </div>
    </div>

    <x-box>
        <div class="changelog">
            {!! $changelog !!}
        </div>

        <style>
            .changelog h1{
                font-size: 2em;
                font-weight: bold;
            }
            .changelog h2{
                font-size: 1.4em;
                font-weight: bold;
                margin-top: 20px;
            }
            .changelog h3{
                font-size: 1.2em;
                font-weight: bold;
                margin-top: 10px;
            }

            .changelog ul{
                list-style: disc;
                padding-left: 1em;
            }

            .changelog a{
                text-decoration: underline;
            }
        </style>
    </x-box>
</x-app-layout>
