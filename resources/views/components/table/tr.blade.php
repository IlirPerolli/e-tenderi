<tr class="{{ ($index ?? 0) % 2 == 0 ? 'bg-white' : 'bg-gray-50' }}">
    {{ $slot }}
</tr>
