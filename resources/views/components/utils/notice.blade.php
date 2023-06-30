<div>
    @if(session('error'))
        <x:toast>
            {{session('error')}}
        </x:toast>
    @endif

    @if(session('success'))
        <x:toast>
            {{session('success')}}
        </x:toast>
    @endif
</div>
