<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Services\PostStoreService;

//use App\Response\PostStoreResponse;


class PostController extends Controller
{

    /*
    public function store(StorePostRequest $request)
    {
        return app(PostStoreResponse::class, [
            'request' => $request->validated()
        ]);
    }
    */

    public function store(StorePostRequest $request)
    {
//        dd($request->validated());
        return app(PostStoreService::class)->handle($request->validated());
    }

}
