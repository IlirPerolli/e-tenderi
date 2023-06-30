@if($attributes->has('solid'))
    <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
         :class="{ 'transform -rotate-90 focus:-rotate-90': !open }">
        <path fill-rule="evenodd"
              d="M12 2.25a.75.75 0 01.75.75v16.19l6.22-6.22a.75.75 0 111.06 1.06l-7.5 7.5a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 111.06-1.06l6.22 6.22V3a.75.75 0 01.75-.75z"
              clip-rule="evenodd"/>
    </svg>

@else
    <svg {{ $attributes }} xmlns="http://www.w3.org/2000/svg" fill="none"
         :class="{ 'transform -rotate-90 focus:-rotate-90': !open }" viewBox="0 0 24 24" stroke-width="1.5"
         stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3"/>
    </svg>
@endif