<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TamuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'redirectToDashboard'])
    ->middleware(['auth', 'check.status', 'verified'])
    ->name('dashboard');


// Admin routes
Route::middleware(['auth', 'check.status', 'role:admin'])->group(function () {
    // Dashboard Admin
    Route::get('admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Tamu routes
    Route::get('admin/tamu/create', [TamuController::class, 'create'])->name('tamu.create');
    Route::post('admin/tamu/create', [TamuController::class, 'store'])->name('tamu.store'); // Perbaikan Controller
    Route::get('admin/tamu/{id}/show', [TamuController::class, 'show'])->name('tamu.show'); // Tambahkan parameter ID

    // Account management
    Route::get('admin/account/create', [AdminController::class, 'create'])->name('account.create');
    Route::post('admin/account/create', [AdminController::class, 'store'])->name('account.store');
    Route::get('admin/show-account/{id}', [AdminController::class, 'show'])->name('account.show');
    Route::get('admin/account/{id}/edit', [AdminController::class, 'edit'])->name('account.edit');
    Route::put('admin/account/{id}', [AdminController::class, 'update'])->name('account.update');
    Route::patch('admin/account/{id}/update-status', [AdminController::class, 'updateStatus'])->name('account.updateStatus');
    Route::delete('admin/account/{id}', [AdminController::class, 'destroy'])->name('account.destroy');

    // Articles
    Route::get('admin/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('admin/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('admin/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
});

// Guest/User routes
Route::middleware(['auth', 'check.status', 'role:guest'])->group(function () {
    Route::get('guest', [GuestController::class, 'index'])->name('guest.dashboard');
    Route::get('guest/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('guest/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('guest/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('guest/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('guest/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('guest/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
