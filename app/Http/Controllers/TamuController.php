<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TamuController extends Controller
{
    /**
     * Form untuk menambahkan tamu baru.
     */
    public function create(Request $request)
    {
        $tamus = Tamu::all();
        $usedSeats = Tamu::pluck('nomor_tempat_duduk')->toArray();
        $angkatan = Tamu::whereIn('nomor_tempat_duduk', $usedSeats)
            ->pluck('angkatan', 'nomor_tempat_duduk')
            ->toArray();

        return view('admin.tamu.create', compact('tamus', 'usedSeats', 'angkatan'));
    }

    /**
     * Proses penyimpanan data tamu ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|in:22,23,24,25,26',
            'nomor_tempat_duduk' => 'required|integer|distinct|min:1|max:20',
            'photo' => 'required|string', // Foto dalam bentuk Base64
        ]);

        // Cek format base64 yang valid
        if (!preg_match('/^data:image\/(\w+);base64,/', $request->photo, $type)) {
            return back()->with('error', 'Format gambar tidak valid.');
        }

        $extension = strtolower($type[1]);
        if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
            return back()->with('error', 'Format gambar harus PNG atau JPG.');
        }

        $imageData = substr($request->photo, strpos($request->photo, ',') + 1);
        $imageData = base64_decode($imageData);
        if (!$imageData) {
            return back()->with('error', 'Foto gagal diproses.');
        }

        $imageName = 'photo_' . time() . '.' . $extension;
        Storage::disk('public')->put('photos/' . $imageName, $imageData);

        if (!Storage::disk('public')->exists('photos/' . $imageName)) {
            return back()->with('error', 'Foto gagal disimpan.');
        }

        Tamu::create([
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'nomor_tempat_duduk' => $request->nomor_tempat_duduk,
            'photo' => 'photos/' . $imageName,
        ]);

        return redirect()->back()->with('success', 'Tamu berhasil didaftarkan!');
    }

    /**
     * Tampilkan detail tamu berdasarkan ID.
     */
    public function show($id)
    {
        $tamu = Tamu::find($id);

        if (!$tamu) {
            return redirect()->route('tamu.create')->with('error', 'Data tamu tidak ditemukan.');
        }

        return view('admin.tamu.show', compact('tamu'));
    }

    /**
     * Generate nomor tempat duduk otomatis bergantian antar angkatan.
     */
    private function generateNomorTempatDuduk($angkatan)
    {
        $lastNumberForAngkatan = Tamu::where('angkatan', $angkatan)->max('nomor_tempat_duduk') ?? 0;
        $nextNumber = $lastNumberForAngkatan + 1;

        while (
            Tamu::where('nomor_tempat_duduk', $nextNumber)->where('angkatan', '!=', $angkatan)->exists() ||
            Tamu::where('nomor_tempat_duduk', $nextNumber - 1)->where('angkatan', '!=', $angkatan)->exists() ||
            Tamu::where('nomor_tempat_duduk', $nextNumber + 1)->where('angkatan', '!=', $angkatan)->exists()
        ) {
            $nextNumber++;
        }

        return $nextNumber;
    }
}
