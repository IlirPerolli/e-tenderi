@error($for)
<p {{$attributes->merge(['class' => 'mt-1 text-sm text-tertiary-500'])}}>
    {{ $message }}
</p>
@enderror
