<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Tampilkan daftar pengguna di dashboard admin.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    /**
     * Tampilkan form untuk membuat akun baru.
     */
    public function create()
    {
        return view('admin.akun.create');
    }

    /**
     * Simpan akun baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,guest',
        ]);

        // Buat pengguna baru
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        // Redirect ke dashboard admin
        return redirect()->route('admin.dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    /**
     * Tampilkan detail pengguna berdasarkan ID.
     */
    public function show($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Tampilkan view dengan data pengguna
        return view('admin.akun.show', compact('user'));
    }

    /**
     * Tampilkan form untuk mengubah data pengguna.
     */
    public function edit($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Tampilkan view dengan data pengguna
        return view('admin.akun.edit', compact('user'));
    }

    /**
     * Perbarui data pengguna.
     */

    public function update(Request $request, $id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,guest',
        ]);

        // Update data pengguna
        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Redirect ke dashboard admin
        return redirect()->route('admin.dashboard')->with('success', 'Data pengguna berhasil diubah!');
    }

    /**
     * Hapus pengguna berdasarkan ID.
     */
    public function destroy($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus pengguna
        $user->delete();

        // Redirect ke dashboard admin
        return redirect()->route('admin.dashboard')->with('success', 'Akun pengguna berhasil dihapus!');
    }

    /**
     * Perbarui status pengguna.
     */
    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi nilai status
        $request->validate([
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        // Pastikan admin tidak bisa dinonaktifkan
        if ($user->role === 'admin' && $request->status === 'tidak_aktif') {
            return redirect()->back()->withErrors([
                'status' => 'Status admin tidak dapat diubah menjadi tidak aktif.',
            ]);
        }

        // Update status
        $user->update(['status' => $request->status]);

        return redirect()->route('account.show', $user->id)->with('success', 'Status pengguna berhasil diubah!');
    }
}
