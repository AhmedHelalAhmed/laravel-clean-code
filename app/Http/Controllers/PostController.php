<?php

namespace App\Http\Controllers;

class PostController extends Controller
{
    private $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;

        $this->middleware('auth', [
            'only' => [
                'store', 'update',
            ],

        ]);
/* 
$this->middleware('auth', [
'except' => [
'index',
],

]);
 */
    }

    public function index()
    {

    }
    public function store()
    {

    }
    public function update()
    {

    }
}
