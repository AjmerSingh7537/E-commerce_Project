<?php namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAnAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if($request->user() && !$request->user()->is_admin())
        {
            return redirect()->back();
        }
		return $next($request);
	}

}
