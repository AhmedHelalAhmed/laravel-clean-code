<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{

    private $post;


    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    public function __call($name, $arguments)
    {
        return $this->post->$name(...$arguments);
    }

}
