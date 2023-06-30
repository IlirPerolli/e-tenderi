@if(isset($tooltip))
    <p class="mb-1 text-xs text-secondary-400">
        {{$tooltip}}
    </p>
@endif
<label {{$attributes->merge(['class' => 'block whitespace-nowrap text-neutral-black'])}}>
    {{$slot}}
</label>