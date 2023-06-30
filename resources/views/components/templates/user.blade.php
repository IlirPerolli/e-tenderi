<div class="hover:underline">
    @if ($object)
        <a href="{{ route('users.show', $object) }}">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full mr-3 object-cover">
                    <img class="w-full h-full object-cover rounded-full" src="{{$object->image}}" alt="Image"/>
                </div>
                <div class="flex flex-col">
                    <div class="text-secondary-800 dark:text-quaternary-50 whitespace-nowrap">{{$object->name}}</div>
                    <div class="antialiased text-secondary-400 dark:text-secondary-600">{{$object->email}}</div>
                </div>
            </div>
        </a>
    @else
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-full mr-3 object-cover">
                <img class="w-full h-full object-cover rounded-full" src="{{ asset('assets/defaults/user.svg') }}"/>
            </div>
            <div class="w-32 text-tertiary-500">Deleted User</div>
        </div>
    @endif
</div>