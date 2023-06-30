<a {{ $attributes->merge(['href' => '#','class' => 'block px-4 py-2 text-sm leading-5 text-secondary-700 hover:bg-secondary-100 dark:text-white dark:hover:text-primary-400 dark:hover:bg-quaternary-100 focus:outline-none transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>
