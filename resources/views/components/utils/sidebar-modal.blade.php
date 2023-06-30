@props(['id', 'maxWidth', 'overflow'=> 'hidden'])

@php
    $id = $id ?? md5($attributes->wire('model'));
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        '6xl' => 'sm:max-w-6xl',
        '7xl' => 'sm:max-w-7xl',
    ][$maxWidth ?? 'md'];

    switch ($overflow) {
        case 'hidden':
            $overflow = 'overflow-hidden';
            break;
    }
@endphp

<div>
    <div x-data="{ open: @entangle($attributes->wire('model')).defer }"
         @keydown.window.escape="open = false"
         x-show="open"
         x-cloak
         class="relative z-10" aria-labelledby="slide-over-title" x-ref="dialog" aria-modal="true">
        <div x-show="open"
             x-transition:enter="ease-in-out duration-500"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in-out duration-500"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="z-50 fixed bottom-0 inset-x-0 px-4 pb-4 inset-0 flex items-center justify-center backdrop-blur-sm">
            <div class="absolute inset-0 bg-secondary-500 dark:bg-quaternary-100 opacity-50"></div>
            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                        <div x-show="open"
                             x-transition:enter="transform transition ease-in-out duration-500"
                             x-transition:enter-start="translate-x-full"
                             x-transition:enter-end="translate-x-0"
                             x-transition:leave="transform transition ease-in-out duration-500"
                             x-transition:leave-start="translate-x-0"
                             x-transition:leave-end="translate-x-full"
                             class="pointer-events-auto w-screen {{ $maxWidth }}"
                             @click.away="open = false">
                            <div class="flex h-full flex-col overflow-hidden bg-white dark:bg-gray-900">
                                <div class="px-4 py-6 bg-secondary-800 dark:bg-quaternary-300 border-b border-secondary-700">
                                    <div class="flex items-start justify-between">
                                        <div class="font-sora">
                                            <h2 class="text-xl text-neutral-white">
                                                <b>{{ $title }}</b>
                                            </h2>

                                            @if(isset($subtitle))
                                                <p class="text-sm text-gray-500">
                                                    {{ $subtitle }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-1 relative overflow-y-auto focus:outline-none bg-gray-100 dark:bg-quaternary-200 transition duration-200">
                                    <div class="p-4 h-full">

                                        {{ $slot }}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
