<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostStoreService
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    public function handle($request)
    {
        $this->posts->create($request);

        return response(null, 201);

    }

}