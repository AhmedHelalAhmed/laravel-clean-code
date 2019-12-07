<?php

namespace App\Http\Controllers;

use App\Response\PostStoreResponse;

class PostController extends Controller
{

    public function store()
    {
        // dd($request->all());

        // dd($request->validated()); // user_id does not exists
        /*
        Post::create($request->validated());
        return response(null, 201);
        */

        /*
        return new PostStoreResponse;
        // but i need to send PostRepository
        // to solve this
        */

        return app(PostStoreResponse::class);
        // in this case laravel automatically inject PostRepository

    }

}
