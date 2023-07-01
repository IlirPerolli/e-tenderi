<x:link href="#"
        x-data=""
        @click.prevent="$dispatch('open-delete-modal', '{{ $item }}')">
    {{ __('Delete') }}
</x:link>
