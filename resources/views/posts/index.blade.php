<div>
    <div class="grid gap-4 grid-cols-1 md:grid-cols-4 md:gap-4">
        @foreach($posts as $post)
            <x:posts.card :post="$post"/>
        @endforeach
    </div>
    <div class="mt-5">
        {{$posts->links()}}
    </div>
</div>
