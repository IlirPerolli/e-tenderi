<div x-data="{isUploading: true, progress: 0}"
     x-init="isUploading = false" x-cloak
     x-on:livewire-upload-start="isUploading = true"
     x-on:livewire-upload-finish="isUploading = false"
     x-on:livewire-upload-error="isUploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress"
     class="w-full mt-1">
    <div x-show.transition="isUploading" class="w-full max-w-xl bg-secondary-200 rounded-full h-2">
        <div class="bg-primary-400 h-2.5 rounded-full"
             x-bind:style="`width: ${progress}%`"></div>
        <h1 class="text-tertiary-500 text-sm" x-text="`Uploading ${progress}%`"></h1>
    </div>
    {{$slot}}
</div>
