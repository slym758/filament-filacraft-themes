<?php

namespace Slym758\FilaCraft\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyThemeLayout
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
