<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{

    public function store(StorePostRequest $request)
    {
        return Post::create($request->validated());

    }

}
