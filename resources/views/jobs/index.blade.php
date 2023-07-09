<div>
    @include('jobs.partials.filters')

    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 md:gap-4">
        @forelse($jobs as $job)
            <x:tenders.card :item="$job"/>
        @empty
            <div class="flex justify-center col-span-4 text-red-600">No data.</div>
        @endforelse
    </div>

    <div class="mt-5">
        {{$jobs->links()}}
    </div>
    <x:delete-item-modal/>
</div>
