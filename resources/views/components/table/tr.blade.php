@php($bgColor = ($index ?? 0) % 2 == 0 ? 'bg-white dark:bg-quaternary-200' : 'bg-gray-50 dark:bg-quaternary-300')
<tr {{ $attributes->merge(['class'=> "$bgColor "]) }}>
    {{ $slot }}
</tr>
