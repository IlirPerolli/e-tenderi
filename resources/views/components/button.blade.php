<button {{ $attributes->merge(['type' => 'submit',  'class' => 'inline-flex items-center px-4 py-3 bg-primary-400 rounded-md text-sm text-neutral-white uppercase tracking-widest hover:bg-secondary-700 active:bg-secondary-900 focus:outline-none focus:border-secondary-900 focus:ring ring-secondary-300 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
