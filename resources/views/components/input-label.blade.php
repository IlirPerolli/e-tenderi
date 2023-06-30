@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-secondary-700 dark:text-secondary-300']) }}>
    {{ $value ?? $slot }}
</label>