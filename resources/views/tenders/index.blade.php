<div>
    @include('tenders.partials.filters')
    <div class="grid gap-4 grid-cols-1 md:grid-cols-4 md:gap-4">
        @forelse($tenders as $tender)
            <x:tenders.card :item="$tender"/>
        @empty
            <div class="flex justify-center col-span-4 text-red-600">No data.</div>
        @endforelse
    </div>
    <div class="mt-5">
        {{$tenders->links()}}
    </div>
    <x:delete-item-modal/>
</div>
