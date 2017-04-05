<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        try{

            if (!\Auth::check()) {
               return redirect('/admin/login');
            }
           


            if(\Auth::user()->type==="Admin")
            {    
                return $next($request);
            }
            else
            {
                return redirect('/');
            }
        }catch(\Exception $e)
        {
            return redirect('/');
        }
    }
}
