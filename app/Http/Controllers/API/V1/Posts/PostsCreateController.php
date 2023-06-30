<?php

namespace App\Http\Controllers\API\V1\Posts;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Posts\CreatePostRequest;
use App\Http\Resources\API\V1\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostsCreateController extends APIController
{
    public function __invoke(CreatePostRequest $request): JsonResponse
    {
        $post = Post::query()->create($request->validated());
        return $this->respondWithSuccess(PostResource::make($post));
    }
}
