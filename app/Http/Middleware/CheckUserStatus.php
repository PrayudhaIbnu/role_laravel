<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sedang login
        if (Auth::check()) {
            // Ambil pengguna yang sedang login
            $user = Auth::user();

            // Jika status pengguna tidak aktif, logout dan arahkan ke halaman login
            if ($user->status === 'tidak_aktif') {
                Auth::logout();

                return redirect()->route('login')->withErrors([
                    'email' => 'Akun Anda tidak aktif. Silakan hubungi admin untuk informasi lebih lanjut.'
                ]);
            }
        }

        return $next($request);
    }
}
