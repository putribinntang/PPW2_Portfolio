<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::view('/', 'home')->name('home');

Route::view('/about', 'about')->name('about');

Route::view('/education', 'education')->name('education');

Route::get('/projects/trash', [ProjectController::class, 'trash'])
    ->name('projects.trash');

Route::patch('/projects/{id}/restore', [ProjectController::class, 'restore'])
    ->name('projects.restore');

Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])
    ->name('projects.forceDelete');

Route::resource('projects', ProjectController::class);