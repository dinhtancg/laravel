<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class firstlogin
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
      if ( !Auth::user()->first_login)
        {
//            dd('aaa');
//            return redirect()->route('admin.user.changepassword');
            return redirect()->route('admin.user.changepassword', ['user' => Auth::user()->id]);
        }

        return $next($request);
    }
}
