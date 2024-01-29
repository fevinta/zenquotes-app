<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        } else if ($request->routeIs('secure-quotes')) {
            return route('quotes');
        } else if ($request->routeIs('favorite-quotes')) {
            return route('quotes');
        } else if ($request->routeIs('report-favorite-quotes')) {
            return route('quotes');
        }

        return route('login');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->expectsJson()) {
            try {
                $this->authenticate($request, $guards);
            } catch (\Throwable $th) {
                return response()->json([], 401);
            }
        } else {
            $this->authenticate($request, $guards);

            return $next($request);
        }
    }
}
