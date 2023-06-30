<button {{ $attributes->merge(['type' => 'submit', 'class' => 'font-sans inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent rounded text-sm text-white uppercase hover:bg-primary-600 focus:outline-none focus:ring-2 transition ease-in-out duration-150']) }}>
    {{$slot}}
</button>