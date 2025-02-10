<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Angkatan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $angkatan): Response
    {
        if (!$request->tamu() || !$request->tamu()->hasAngkatan($angkatan)) {
            abort(403, 'Unauthorized');
        }
        // Check if user has the required role
        return $next($request);
    }
}
