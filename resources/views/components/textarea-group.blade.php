@props([
    'id' => '' ,
    'label' => false ,
    'disabled' => false,
    'messages' => NULL,
    'required' => NULL ,
    'name' => '',
    'description' => ''
])

<div>
    <div class="relative mt-1 mb-4">
        @if($label)
            <label for="{{$id}}" class="absolute bg-white px-2 text-sm text-gray-500 left-2 -top-2.5">
                {{ $label }}
                @if($required)
                    <span class="text-red-500">*</span>
                @endif
            </label>
        @endif
        <textarea id="{{$id}}"
               name="{{$name}}" {{ $disabled ? 'disabled' : '' }}
               {{ $required ? 'required' : '' }}
               {!! $attributes->merge(['class' => 'border-gray-300 w-full pb-2 pt-3 focus:border-main focus:ring-main-500 rounded-sm shadow-sm', 'rows' => '10']) !!}
        >{{ $slot }}</textarea>

        @if($description !== '')
            <p class="text-xs">{{ $description }}</p>
        @endif

        @if($errors->has($name))
            <ul class="text-sm text-red-600 space-y-1">
                @foreach ($errors->get($name) as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
