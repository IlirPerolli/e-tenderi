<div class="flex items-center space-x-1 text-sm whitespace-nowrap">
    <x:icons.calendar class="h-5 w-5"/>
    <span>
        {{ isset($format) ? date_formatter($date, $format) : date_formatter($date) ?? '-'}}
    </span>
</div>