<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
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
      if(Auth::user()->usertype == 'student')
      {
        return $next($request);
      }
      else {
        return redirect('/authenticity')->with('status','You are not allowed to Student Dashboard');
      }
    }
}
