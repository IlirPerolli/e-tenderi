@props(['post'])
<div class="max-w-sm rounded overflow-hidden shadow-lg relative h-auto">
    <a href="{{$post->url}}" target="_blank">
        <div class="h-40 flex items-center overflow-hidden">
            <img class="w-full object-cover"
                 onerror="this.src = '{{ default_404_image() }}'"
                 src="{{$post->image_path}}" alt="Thumbnail">
        </div>
    </a>
    <div class="px-6 py-4 mb-12">
        <a href="{{$post->url}}" target="_blank">
            <div class="font-bold text-xl mb-2  break-words">{{Str::limit($post->name, 100)}}</div>
        </a>
        <a href="{{$post->url}}" target="_blank">
            <p class="text-gray-700 text-base">
                {{$post->description}}
            </p>
        </a>
    </div>
    <div class="absolute bottom-0 w-full flex pl-6">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#tender</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#grant</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#test</span>
    </div>
</div>
