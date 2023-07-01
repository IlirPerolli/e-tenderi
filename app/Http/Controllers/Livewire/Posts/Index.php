<?php

namespace App\Http\Controllers\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p'],
    ];

    public function render()
    {
        $posts = Post::query()->paginate(12);

        return view('posts.index', compact('posts'));
    }
}
