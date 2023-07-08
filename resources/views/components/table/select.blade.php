@props(['options', 'label'])
<div x-data="{open : false}" class="relative inline-block">
    <a href="#"
       x-on:click.prevent="open=true"
       class="flex items-center focus:outline-none outline-none ">
        <span>{{ $label }}</span>
        <x:icons.chevron-down ::class="{'rotate-180': open, 'rotate-0': !open}"
                              class="inline-flex w-4 h-4 ml-1 transition-transform duration-200 transform"/>
    </a>
    <div x-show.transition="open" x-cloak x-on:click.away="open=false"
         class="absolute origin-top-right right-0 mt-2 w-40 bg-white rounded-md shadow border border-gray-200 z-10">
        <div
            x-data="{ items: @entangle($attributes->wire('model')) }"
            class="p-2 space-y-1">
            @foreach($options as $option)
                <label class="flex items-center text-gray-800 font-medium gap-2">
                    <x:form.input-checkbox
                        id="{{ $option['value'] }}"
                        x-model="items"
                        value="{{ $option['value'] }}"/>

                    <span class="text-sm">{{$option['name']}}</span>
                </label>
            @endforeach
        </div>
    </div>
</div>

