@props(['item'])

<a href="{{ $item->url }}" target="_blank" class="block text-current no-underline">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:bg-gray-50 dark:hover:bg-gray-700 dark:bg-gray-800">
        <div class="p-4 flex">
            <div class="w-16 h-16 mr-4 flex-shrink-0">
                <img onerror="this.src = '{{ default_404_image() }}'"
                     src="{{$item?->provider?->image_path}}" alt="Company Logo"
                     class="w-full h-full object-cover rounded-full">
            </div>
            <div class="flex-grow">
                <h3 class="text-lg font-semibold truncate dark:text-white">{{ Str::limit($item->name, 50) }}</h3>
                <p class="text-sm text-gray-600">{{ $item->description }}</p>
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    @if($item->city)
                        <span
                            class="text-sm bg-blue-100 dark:bg-gray-600 text-blue-800 dark:text-gray-200 px-3 py-1 rounded-full">{{ $item?->city?->name ?? ''}}</span>
                    @endif
                    <span
                        class="text-sm bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full">{{ $item?->deadline?->format('d.M.Y') ?? 'No Deadline' }}</span>
                    <span
                        class="text-sm bg-gray-100 dark:bg-gray-600 text-gray-800 dark:text-gray-200 px-3 py-1 rounded-full">{{ $item->provider->name }}</span>
                </div>
            </div>
        </div>
    </div>
</a>
