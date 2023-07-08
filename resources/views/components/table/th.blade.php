@php($pl = ($isFirst ?? false) ? 'pl-0 z-30' : 'pl-3')

<th {{ $attributes->merge(['class'=>"$pl sticky z-10 -top-1 pr-3 py-3 bg-white border-b text-left text-xs leading-4 font-medium text-gray-500 tracking-wider whitespace-nowrap"]) }}>
    {!! $slot !!}
</th>
