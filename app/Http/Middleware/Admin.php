<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if (auth()->user()->id == 4 && auth()->user()->role_id == 3) {
            return $next($request);
        }
        //return abort(401, 'Unauthorized action.');
        return redirect('/')->with('error','You have not admin access');
        
    }
}
