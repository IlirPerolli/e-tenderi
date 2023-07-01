@props(['type' => 'text', 'name' => ''])
<input type="{{$type}}" id="{{ $name }}"
        {{ $attributes->merge(['class' => "bg-neutral-white dark:bg-gray-800 dark:border-quaternary-100 dark:text-white placeholder:text-secondary-500 border-secondary-200 text-sm focus:ring-primary-400 focus:border-primary-400 hover:ring-primary-400 hover:border-primary-400 rounded-md shadow-sm transition duration-200"]) }}/>
<x:form.error :for="$name"/>
