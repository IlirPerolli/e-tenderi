@props([
'selected',
'items',
'maxHeight' => 300,
'setValueOnClose' => false,
'title' => 'Select items',
'width' => 'w-full',
'showIndex' => false,
])
<livewire:functions.create-category/>
<div x-data="{
               open:false,
               selected: @entangle($selected).defer,
               initial: @entangle($selected).defer,
               items: @entangle($items),
               filtered: [],
               query: '',
               setValueOnClose: '{{ $setValueOnClose }}'
            }"
     x-init="
            filtered = items;

            $watch('query', value => {
                filtered = items.filter(option => {
                    return (option.name.toLowerCase().indexOf(value) > -1)
                })
            });

            $watch('open', value => {
                if(value) {
                    filtered = items.filter(option => {
                        return option
                    })
                    $nextTick(() => $refs.query.focus());
                } else {
                    if(setValueOnClose){
                      if(!areArraysEqual(initial, selected))
                      {
                          $wire.set('{{ $selected }}', selected)
                      }
                    }
                }
            });
            "
     class="relative">
    <button type="button"
            @click="open = true"
            class="relative w-full bg-white dark:text-white dark:bg-quaternary-300 border border-gray-300 dark:border-quaternary-100 hover:border-primary-400 rounded-md pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm text-gray-500 transition duration-200">
        <span class="block truncate flex items-center space-x-1.5">
            <span class="flex gap-2">
                {{ $trigger }}
            </span>
            <span x-show="selected.length > 0"
                  x-cloak
                  class="bg-primary-400 text-white w-5 h-5 flex items-center justify-center text-xs rounded-full">
                <span x-text="selected.length"></span>
            </span>
        </span>
        <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
            <x:icons.chevron class="w-4 h-4 transition-transform duration-500"/>
        </span>
    </button>

    <div x-show="open"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click.away="open = false"
         class="absolute right-0 z-50 mt-1 {{$width}} bg-white dark:bg-quaternary-300 shadow-lg rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
         style="display: none;">
        <div class="flex items-center w-full justify-between">
            <div class="p-2 dark:text-white">{{ $title }}</div>
            <div @click="open = false" wire:click.prevent="$emit('openCategoryModal')"
                 class="mr-2 cursor-pointer rounded-md w-full sm:w-fit px-2 py-1 bg-primary-500 text-sm text-white hover:bg-primary-600 focus:outline-none focus:ring-2 transition ease-in-out duration-150">
                {{ __('Add New') }}
            </div>
        </div>
        <div class="flex items-center border-b border-gray-200">
            <input type="search"
                   x-model="query"
                   x-ref="query"
                   class="block border-0 bg-white dark:text-white dark:bg-quaternary-300 focus:border-white focus:ring-0 rounded-md sm:text-sm w-full"
                   placeholder="Search...">
        </div>

        <div style="max-height: {{ $maxHeight }}px;" class="overflow-auto">
            <template
                    x-for="item in filtered" :key="item.id">
                <label
                        class="flex items-center block px-2 py-2 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-quaternary-100 border-b border-gray-200 dark:border-quaternary-300 cursor-pointer">
                    <span>
                        <x:form.checkbox name="" x-model="selected" ::value="item.id"
                                         class="ml-auto"/>
                    </span>
                    {{ $item }}

                    @if($showIndex)
                        <div x-show="selected.includes(`${item.id}`)" x-cloak
                             class="float-right bg-gray-200 text-gray-500 border border-gray-300 w-5 h-5 flex items-center justify-center text-xs rounded-full">
                            <span x-text="selected.indexOf(`${item.id}`) + 1"></span>
                        </div>
                    @endif
                </label>
            </template>
            <template x-if="filtered && filtered.length == 0">
                <div class="flex items-center block px-2 py-2 text-gray-900 dark:text-white">
                    No Data Found
                </div>
            </template>
        </div>
        <div>
            <div class="p-3 text-xs text-gray-500 dark:text-white">
                <span x-text="selected.length"></span> items selected
                <span class="float-right">
                    <button
                            @click.prevent="selected = items.map(item => {return `${item.id}`})"
                            type="button"
                            class="mr-3 rounded px-px text-blue-600">
                        Select All
                    </button>
                    <button
                            @click.prevent="selected = []"
                            type="button"
                            class="mr-2 rounded px-px text-blue-600">
                        Reset
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>
