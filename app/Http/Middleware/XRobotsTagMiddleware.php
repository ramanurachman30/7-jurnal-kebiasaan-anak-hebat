<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XRobotsTagMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Mengatur header X-Robots-Tag
        $response->header('X-Robots-Tag', 'index, follow');
        return $response;
    }
}
