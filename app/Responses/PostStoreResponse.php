<?php

namespace App\Response;

use App\Repositories\PostRepository;

use Illuminate\Contracts\Support\Responsable;

class PostStoreResponse implements Responsable
{
    private $posts;

    public function __construct(PostRepository $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        /*
          create not exists in the PostRepository but
          this will call magic function __call and it will handle that

         */
        $this->posts->create($request->all());

        return response(null, 201);

    }
}
