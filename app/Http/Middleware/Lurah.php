<?php

namespace App\Http\Middleware;

use App\Helper\ApiFormatter;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Lurah
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->level !== 'kelurahan')
        return ApiFormatter::createApi(404, 'not found');
        return $next($request);
    }
}
