<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->hasRole('guest')) {
        return redirect()->route('guest.dashboard');
    }

    return view('dashboard'); // Untuk user biasa
})->middleware(['auth', 'check.status', 'verified'])->name('dashboard');


Route::middleware(['auth', 'check.status', 'role:admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/account/create', [AdminController::class, 'create'])->name('account.create');
    Route::post('admin/account/create', [AdminController::class, 'store'])->name('account.store');
    Route::get('admin/show-account/{id}', [AdminController::class, 'show'])->name('account.show');
    Route::get('admin/account/{id}/edit', [AdminController::class, 'edit'])->name('account.edit');
    Route::put('admin/account/{id}', [AdminController::class, 'update'])->name('account.update');
    Route::patch('admin/account/{id}/update-status', [AdminController::class, 'updateStatus'])->name('account.updateStatus');
    Route::delete('admin/account/{id}', [AdminController::class, 'destroy'])->name('account.destroy');
});


Route::middleware(['auth', 'check.status', 'role:guest'])->group(function () {
    Route::get('guest', [GuestController::class, 'index'])->name('guest.dashboard');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
