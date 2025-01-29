@props(['id' => '' , 'label' => false , 'disabled' => false, 'messages' => NULL, 'required' => NULL , 'name' => '', 'options' => '', 'value' => '' ])

@php
    $renderOptions = array();
    if(!empty($options))
    {
        $tmpOptions = explode(";", $options);

        foreach($tmpOptions as $option)
        {
            list($tmpVal, $tmpLabel) = explode(":", $option);
            $renderOptions[$tmpVal] = $tmpLabel;
        }
    }
@endphp

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
        <select id="{{$id}}"
               name="{{$name}}"
               {{ $disabled ? 'disabled' : '' }}
               {{ $required ? 'required' : '' }}
               {!! $attributes->merge(['class' => 'border-gray-300 w-full pb-2 pt-3 focus:border-main focus:ring-main-500 rounded-sm shadow-sm']) !!}
        >
        @foreach($renderOptions as $val => $label)
            <option value="{{ $val }}" {{ ($val == $value ? 'selected' : '') }}>{{ __($label) }}</option>
        @endforeach
    </select>

        @if($errors->has($name))
            <ul class="text-sm text-red-600 space-y-1">
                @foreach ($errors->get($name) as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
