<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Ajax
{
    /**
     * Only proceed if incoming request is ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        return $next($request);
    }
}
