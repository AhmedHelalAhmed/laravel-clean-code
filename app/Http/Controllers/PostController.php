<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class PostController extends Controller
{

    public function store(StorePostRequest $request)
    {
        // dd($request->all());
        Post::create($request->all());
        return response(null, 201);

    }

}
