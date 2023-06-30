<div class="bg-neutral-white dark:bg-quaternary-100 -ml-1 overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <div class="pb-4">
            @if(isset($title))
                <h3 class="text-lg leading-6 text-secondary-900 dark:text-white">
                    {{ $title }}
                </h3>
            @endif
            @if(isset($subtitle))
                <p class="mt-1 max-w-2xl text-sm leading-5 text-secondary-500">
                    {{ $subtitle }}
                </p>
            @endif
            {{ $header ?? null }}
        </div>
        {{ $slot }}
    </div>
</div>
