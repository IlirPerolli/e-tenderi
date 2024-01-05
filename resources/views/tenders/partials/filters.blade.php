<div class="flex items-center gap-4 mb-5 flex-wrap">
    <div class="relative w-full sm:w-72">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <x:icons.search class="h-5 w-5 text-gray-400"/>
        </div>

        <x-form.input class="pl-10 w-full" wire:model.debounce.750="query" placeholder="Search..."/>
    </div>
{{--    <div class="relative w-full sm:w-72">--}}
{{--        <x:form.select id="provider" placeholder="Select Providers" wire:model.debounce.750="provider">--}}
{{--            <option value=""> Select Provider </option>--}}
{{--        @foreach($providers as $provider)--}}
{{--                <option value="{{ $provider->slug ?? ''}}">{{ $provider->name ?? '' }} </option>--}}
{{--            @endforeach--}}
{{--        </x:form.select>--}}
{{--    </div>--}}
    <div class="relative w-full sm:w-72">
        <x:form.select id="city" placeholder="Select Cities" wire:model.debounce.750="city">
            <option value=""> Select City </option>
            @foreach($cities as $city)
                <option value="{{ $city->slug ?? ''}}">{{ $city->name ?? '' }} </option>
            @endforeach
        </x:form.select>
    </div>
    <div class="relative w-full sm:w-72">
        <x:form.select id="category" placeholder="Select Categories" wire:model.debounce.750="category">
            <option value=""> Select Category </option>
            @foreach($categories as $category)
                <option value="{{ $category->slug ?? ''}}">{{ $category->name ?? '' }} </option>
            @endforeach
        </x:form.select>
    </div>

{{--    <div class="">--}}
{{--        <a href="#">--}}
{{--            <x:primary-button>Add Tender</x:primary-button>--}}
{{--        </a>--}}
{{--    </div>--}}


</div>
