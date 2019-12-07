<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Response\PostStoreResponse;

class PostController extends Controller
{

    public function store(StorePostRequest $request)
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

        return app(PostStoreResponse::class, [
            'request' => $request->validated()
        ]);
        // in this case laravel automatically inject PostRepository

    }

}
