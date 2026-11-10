<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectImageController;

// Halaman publik
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/education', 'education')->name('education');
Route::view('/experience', 'experience')->name('experience');

// My Profile (khusus pengguna login)
Route::get('/myprofile', function () {
    return view('myprofile');
})->middleware('auth')->name('myprofile');

// Daftar project (publik)
Route::get('/projects', [ProjectController::class, 'index'])
    ->name('projects.index');

// Pengelolaan project (khusus admin)
Route::middleware(['auth', 'admin'])->group(function () {

    // Trash harus sebelum route dinamis
    Route::get('/projects/trash', [ProjectController::class, 'trash'])
        ->name('projects.trash');

    Route::patch('/projects/{id}/restore', [ProjectController::class, 'restore'])
        ->name('projects.restore');

    Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])
        ->name('projects.forceDelete');

    // Create, store, edit, update, destroy
    Route::resource('projects', ProjectController::class)
        ->except(['index', 'show']);

    // Gallery Project
    Route::post('/projects/{project}/images', [ProjectImageController::class, 'store'])
        ->name('projects.images.store');

    Route::put('/projects/{project}/images/{image}', [ProjectImageController::class, 'update'])
        ->name('projects.images.update');

    Route::delete('/projects/{project}/images/{image}', [ProjectImageController::class, 'destroy'])
        ->name('projects.images.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

// Detail project (publik, diletakkan paling akhir)
Route::get('/projects/{project}', [ProjectController::class, 'show'])
    ->name('projects.show');

// Profile Breeze (khusus pengguna login)
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Autentikasi Breeze
require __DIR__.'/auth.php';