@if ($href == url()->full())
    <a href="{{$href ?? ''}}"
       class="flex bg-secondary-900 dark:bg-quaternary-200 text-primary-400 hover:bg-black p-3 pl-2 relative">
        @else
            <a href="{{$href ?? ''}}"
               class="flex bg-secondary-900 dark:bg-quaternary-300 hover:bg-black hover:text-primary-400 duration-150 text-white p-3 pl-2 relative">
                @endif
                <span class="w-6 ml-6">
                    @if ($hasOther == 'true')
                        <x:icons.branch-start/>
                    @else
                        <x:icons.branch-end/>
                    @endif
                </span>
                <div class="">
                    <span class=""> {{$slot}} </span>
                </div>
            </a>
    </a>
