<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DankaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dankas/index', [DankaController::class, 'index'])->name('dankas.index');
    Route::get('/dankas/register', [DankaController::class, 'create'])->name('dankas.register');
    Route::post('/dankas/register', [DankaController::class, 'store']);
    Route::get('/dankas/{id}/edit', [DankaController::class, 'edit'])->name('dankas.edit');
    Route::patch('/dankas/{id}/edit', [DankaController::class, 'update'])->name('dankas.update');
    Route::delete('/dankas/destroy', [DankaController::class, 'destroy'])->name('dankas.destroy');
});

require __DIR__.'/auth.php';
