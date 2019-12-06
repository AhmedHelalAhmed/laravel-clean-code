<?php

namespace App\Http\Middleware;

use Closure;

class InjectUserIdIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd(auth()->check());

        if (auth()->check()) {
            //dd(auth()->id());

            $request->merge(['user_id' => auth()->id()]);
        }

        return $next($request);
    }
}
