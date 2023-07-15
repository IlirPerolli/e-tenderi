@props(['options' => [], 'value' => 'id', 'visibleField' => 'name', 'placeholder'=>null, 'disabled' => false, 'toolTip' => ''])
<select @if($disabled) disabled @endif
        {{ $attributes->merge(['class'=> 'w-full bg-neutral-white dark:bg-gray-800 dark:border-quaternary-100 dark:text-white placeholder:text-secondary-500 border-secondary-200 text-sm focus:ring-primary-400 focus:border-primary-400 hover:ring-primary-400 hover:border-primary-400 rounded-md shadow-sm transition duration-200']) }}>
    @if(count($options) > 0)
        <option value="{{ null }}">{{ $placeholder }}</option>
    @endif

    @foreach($options as $option)
        <option value="{{ $option[$value] ?? ''}}">{{ $option[$visibleField] ?? '' }} {{ $option[$toolTip] ?? '' }}</option>
    @endforeach
    {{ $slot }}
</select>
