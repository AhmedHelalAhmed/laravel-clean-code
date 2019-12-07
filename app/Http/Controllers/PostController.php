<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class PostController extends Controller
{

    public function store(StorePostRequest $request)
    {
        // dd($request->all());

        // dd($request->validated()); // user_id does not exists
        Post::create($request->validated());
        return response(null, 201);

    }

}
