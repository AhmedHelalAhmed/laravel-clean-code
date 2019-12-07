<?php

namespace App\Response;

use App\Repositories\PostRepository;

use Illuminate\Contracts\Support\Responsable;

/*
 *  store action implementation only
 *  this make the code single with it self
 *  you can make protected methods as you like
 *  instead of using controller
 *  this way to prepare data instead of making protected functions in controller
 */
class PostStoreResponse implements Responsable
{
    private $posts;
    private $request;

    public function __construct(PostRepository $posts,array $request)
    {
        $this->posts = $posts;
        $this->request = $request;
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
        $this->posts->create($this->request);

        return response(null, 201);

    }
}
