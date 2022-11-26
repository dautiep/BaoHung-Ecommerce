<?php

namespace App\Http\Middleware\Permission;

use App\Traits\HasPermissionsTrait;
use Closure;
use Illuminate\Http\Request;

class PerimissionMiddleware
{
    use HasPermissionsTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (empty($roles)) {
            return $next($request);
        }
        $is_role = is_can($roles);
        if (!$is_role) {
            abort(403);
        }
        return $next($request);
    }
}
