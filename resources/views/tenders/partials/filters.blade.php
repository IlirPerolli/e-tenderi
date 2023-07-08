<div class="flex items-center gap-4 mb-5">
    <div class="relative w-72">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <x:icons.search class="h-5 w-5 text-gray-400"/>
        </div>

        <x-form.input class="pl-10 w-full" wire:model.debounce.750="query" placeholder="Search..."/>
    </div>
    <div class="relative w-72">
        <x:form.select id="parent_id" placeholder="Select Companies" wire:model.debounce.750="company">
            <option value=""> Select Companies </option>
        @foreach($companies as $company)
                <option value="{{ $company->slug ?? ''}}">{{ $company->name ?? '' }} </option>
            @endforeach
        </x:form.select>
    </div>
    <a href="#">
        <x:primary-button>Add tender</x:primary-button>
    </a>

</div>
