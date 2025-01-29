@props([
    'id' => '',
    'label' => false,
    'disabled' => false,
    'messages' => NULL,
    'required' => NULL,
    'readonly' => NULL,
    'type' => 'text',
    'name' => '',
    'description' => '',
    'checked' => false,
    'value' => '',
])
@php
$baseClasses = 'border-gray-300 focus:border-main focus:ring-main-500 rounded-sm shadow-sm';
if( $readonly || $disabled )
{
    $baseClasses = 'border-gray-300 bg-gray-200 focus:border-transparent focus:ring-0 rounded-sm shadow-sm';
}
@endphp
<div>
    <div class="relative mt-1 mb-4">
        <input id="{{$id}}" type="checkbox"
               name="{{$name}}" type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {{ $required ? 'required' : '' }} class="{{ $baseClasses }}"
               value="{{ $value }}"
               @if($checked) checked @endif
        >

       @if($label)
           <label for="{{$id}}" class="text-sm text-gray-500">
               {{$label}}
               @if($required)
                   <span class="text-red-500">*</span>
               @endif
           </label>
       @endif

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
