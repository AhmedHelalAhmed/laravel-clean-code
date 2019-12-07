<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class Debugbar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);




        if ($response instanceof JsonResponse && app('debugbar')->isEnabled() && $request->has('_debug')) {


            //dd(app('debugbar')->getData());


            $response->setData($response->getData(true) + [
                    '_debugbar' => Arr::only(app('debugbar')->getData(), ['queries', 'memory'])
                ]);
        }


        return $response;
    }

    /*
     sql optimization and avoid N+1
     - queries from debugbar =>  to avoid (N+1)

    we have two ways to load:

    1- Eager loading  => if you sure every post object must have user object (must loading)
    2- lazy loading   => if the comment may have or not =>  (conditional loading)
    3- linear => normal (so slow)
    //-----------------------------------//
    example for N+1:

    $post=post::all();// select * from posts => 10 posts => 1 query

    foreach($posts as $post)
    {
        // select * from users where id = post.user_id => 10 users => 10 queries
        echo $post->user->username;
    }

    // 11 queries
    //-----------------------------------//
    lazy loading
        in resource:
        new UserResource($this->>whenLoaded('user')) => good
        instead of
        new UserResource($this->user) => bad
        $this->mergeWhen(Cond,['replies'=>''])

    Eager loading
    $this->>response->getData()->load('user') //try it
    $posts=$this->>posts->approved()->with('user')->get()









     */



}
