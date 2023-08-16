@props(['item'])
<div class="rounded overflow-hidden shadow-lg relative h-auto dark:bg-gray-800">
    <a href="{{$item->url}}" target="_blank">
        <div class="h-64 flex items-center overflow-hidden">
            <img class="w-full object-cover max-h-full"
                 onerror="this.src = '{{ default_404_image() }}'"
                 src="{{$item->image_path ?? $item?->provider?->image_path}}" alt="Thumbnail">
        </div>
    </a>
    <div class="px-6 py-4 mb-12">
        <a href="{{$item->url}}" target="_blank">
            <div class="font-bold text-md mb-2 break-words dark:text-white" title="{{$item->name}}">{{Str::limit($item->name, 50)}}</div>
        </a>
        <a href="{{$item->url}}" target="_blank">
            <p class="text-gray-700 text-base break-words dark:text-white" title="{{$item->description}}">
                {{$item->description}}
            </p>
        </a>
    </div>
    <div class="absolute bottom-0 w-full flex pl-6">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 dark:bg-secondary-900 dark:text-white">#{{$item->provider->name ?? 'tender'}}</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 dark:bg-secondary-900 dark:text-white"><x:icons.clock class="w-5 mb-0.5 inline"/>{{$item->deadline ?? 'No deadline'}}</span>
    </div>
</div>
