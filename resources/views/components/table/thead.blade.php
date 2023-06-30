@props(['fields' => []])
<thead class="border-spacing-0">
<tr>
    @foreach($fields ?? [] as $field)
        <th class="px-6 py-3 bg-secondary-100 dark:bg-quaternary-100 text-left text-xs leading-4 text-gray-500 dark:text-quaternary-50 uppercase tracking-wider whitespace-nowrap">
            {!! $field !!}
        </th>
    @endforeach
</tr>
</thead>
