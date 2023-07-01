<div>
    <div>
        <x:table>
            <x:table.thead
                :columns="['Video', 'Title', 'Description', 'Keywords', 'Categories', 'Author', 'Types', 'Video Properties', 'Created At','']"/>
            <tbody>
            @forelse($objects as $object)
                <x:table.tr :index="$loop->index">
                    <x:table.td>
                        <div class="group flex relative  text-sm font-medium text-gray-900  text-left w-32">
                            <div class="relative flex-shrink-0">
                                <a href="{{$object->resource_url}}" target="_blank">
                                    <div class="relative" title="{{!$object->resource_url ? 'Video Processing' : ''}}">
                                        <img
                                            onerror="this.src = '{{ default_404_image() }}'"
                                            src="{{ $object->thumbnail_url}}"
                                            alt="img" class="rounded-md h-20 w-32 mr-3 object-cover">
                                        @if(!$object->resource_url)
                                            <div
                                                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                                <x:icons.loader class="w-6 h-6"/>
                                            </div>
                                        @endif
                                    </div>
                                </a>

                                @if($duration = $object->resource ? $object->resource->properties['duration'] : null)
                                    <div
                                        class="text-sm text-white absolute bg-black bg-opacity-50 px-1 rounded-md right-0 mr-4 mt-4 top-10">

                                        {{ video_timestamp($duration) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </x:table.td>
                    <x:table.td>
                        <div class="{{strlen($object->description) > 30 ? 'w-64 line-clamp-3' : 'whitespace-nowrap'}}" title="{{$object->title ?? '-'}}">
                            <x:link href="{{$object->link}}">{{ $object->title ?? '-' }}</x:link>
                        </div>
                    </x:table.td>
                    <x:table.td>
                        <div class="{{strlen($object->description) > 30 ? 'w-64 line-clamp-3' : 'whitespace-nowrap'}}" title="{{$object->description ?? '-'}}">
                            {{ $object->description ?? '-'}}
                        </div>
                    </x:table.td>
                    <x:table.td>
                        <div class="{{strlen($object->keywords) > 30 ? 'w-64 line-clamp-3' : 'whitespace-nowrap'}}" title="{{$object->keywords ?? '-'}}">
                            {{ $object->keywords ?? '-'}}
                        </div>
                    </x:table.td>
                    <x:table.td>
                        <div class="{{strlen($object->categories) > 30 ? 'w-64 line-clamp-3' : 'whitespace-nowrap'}}" title="{{$object->categories ?? '-'}}">
                            {{ $object->categories ?? '-'}}
                        </div>
                    </x:table.td>
                    <x:table.td>
                        <div class="{{strlen($object->author) > 30 ? 'w-64 line-clamp-3' : 'whitespace-nowrap'}}" title="{{$object->author ?? '-'}}">
                            {{ $object->author ?? '-'}}
                        </div>
                    </x:table.td>
                    <x:table.td>
                        <div class="whitespace-nowrap" title="{{$object->author ?? '-'}}">
                            {{ collect($object->types ?? [])->implode(', ') ?: '-' }}
                        </div>
                    </x:table.td>
                    <x:table.td>
                        <div class="w-64 mr-4">
                            @if($media = $object->resource)
                                <div class="flex">
                                    <div>
                                        <div class="flex">
                                            <h1 class="text-xs text-secondary-900 whitespace-nowrap">Size:</h1>
                                            <h4 class="text-xs font-bold pl-1 whitespace-nowrap"> {{round($media->size/1024/1024, 2)}} MB</h4>
                                        </div>
                                        <div class="flex">
                                            <h1 class="text-xs text-secondary-900 whitespace-nowrap">Width:</h1>
                                            <h4 class="text-xs font-bold pl-1 whitespace-nowrap"> {{$media->properties['width']}} px</h4>
                                        </div>
                                        <div class="flex">
                                            <h1 class="text-xs text-secondary-900 whitespace-nowrap">Height:</h1>
                                            <h4 class="text-xs font-bold pl-1 whitespace-nowrap"> {{$media->properties['height']}} px</h4>
                                        </div>
                                        <div class="flex">
                                            <h1 class="text-xs text-secondary-900 whitespace-nowrap">Bit rate:</h1>
                                            <h4 class="text-xs font-bold pl-1 whitespace-nowrap"> {{$media->properties['bit_rate']}} B</h4>
                                        </div>
                                    </div>
                                    <div class="pl-5">
                                        <div class="flex">
                                            <h1 class="text-xs text-secondary-900 whitespace-nowrap">Nb frames:</h1>
                                            <h4 class="text-xs font-bold pl-1 whitespace-nowrap"> {{$media->properties['nb_frames']}}</h4>
                                        </div>
                                        <div class="flex">
                                            <h1 class="text-xs text-secondary-900 whitespace-nowrap">Frame rate:</h1>
                                            <h4 class="text-xs font-bold pl-1 whitespace-nowrap"> {{$media->properties['frame_rate']}} fps</h4>
                                        </div>
                                        <div class="flex">
                                            <h1 class="text-xs text-secondary-900 whitespace-nowrap">Codec name:</h1>
                                            <h4 class="text-xs font-bold pl-1 whitespace-nowrap"> {{$media->properties['codec_name']}}</h4>
                                        </div>
                                        <div class="flex">
                                            <h1 class="text-xs text-secondary-900 whitespace-nowrap">Thumbnail Width:</h1>
                                            <h4 class="text-xs font-bold pl-1 whitespace-nowrap"> {{$media->properties['thumbnail_width']}} px</h4>
                                        </div>
                                        <div class="flex">
                                            <h1 class="text-xs text-secondary-900 whitespace-nowrap">Thumbnail Height:</h1>
                                            <h4 class="text-xs font-bold pl-1 whitespace-nowrap"> {{$media->properties['thumbnail_height']}} px</h4>
                                        </div>
                                    </div>
                                </div>

                            @else
                                -
                            @endif
                        </div>
                    </x:table.td>
                    <x:table.td class="whitespace-nowrap">{{ date_formatter($object->created_at) ?? '-'}}</x:table.td>
                    <x:table.td>
                        <x:dropdown :relative="false">
                            <x:slot name="trigger">
                                <button type="button" class="focus:outline-none">
                                    <x:icons.dots-vertical/>
                                </button>
                            </x:slot>

                            <x:slot name="content">
                                <x:dropdown-link href="{{ route('tenders.edit', $object) }}">
                                    Edit
                                </x:dropdown-link>
                                <x-dropdown-link href="#" onclick="event.preventDefault();"
                                                 @click.prevent="$dispatch('open-delete-modal', '{{ $object->id }}')">
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </x:slot>
                        </x:dropdown>
                    </x:table.td>
                </x:table.tr>
            @empty
                <x:table.tr>
                    <x:table.td colspan="100%">
                        There are no data.
                    </x:table.td>
                </x:table.tr>
            @endforelse

            </tbody>
        </x:table>

        <div class="mt-10">
            {{ $objects->links() }}
        </div>
    </div>

    <x:delete-item-modal/>
</div>

