<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $userRoleId = auth()->user()->role;

        $map = [
            0 => 'admin',
            1 => 'staff',
            2 => 'petugas',
            3 => 'kepsubseksi',
            4 => 'kepseksi',
        ];

        if (!isset($map[$userRoleId])) {
            abort(403, "Anda tidak memiliki akses yang cukup.");
        }

        $userRoleName = $map[$userRoleId];

        if (!in_array($userRoleName, $roles)) {
            abort(403, "Anda tidak memiliki akses yang cukup.");
        }

        return $next($request);
    }

}
