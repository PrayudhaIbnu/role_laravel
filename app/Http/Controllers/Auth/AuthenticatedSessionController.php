<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Lakukan autentikasi
        $request->authenticate();

        // Periksa status pengguna setelah berhasil autentikasi
        $user = $request->user();

        if ($user->status === 'tidak_aktif') {
            // Logout pengguna jika statusnya tidak aktif
            Auth::guard('web')->logout();

            // Menghapus data sesi
            session()->invalidate();
            session()->regenerateToken();

            // Setel pesan error
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda tidak aktif. Silakan hubungi admin untuk informasi lebih lanjut.'
            ]);
        }


        // Regenerasi sesi setelah autentikasi
        $request->session()->regenerate();

        // Tentukan URL yang dituju berdasarkan role
        $url = 'dashboard';

        if ($user->role == "admin") {
            $url = 'admin';
        } elseif ($user->role == "guest") {
            $url = "guest";
        }

        return redirect()->intended($url);
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
