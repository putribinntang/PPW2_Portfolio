<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::view('/', 'home')->name('home');

Route::view('/about', 'about')->name('about');

Route::view('/education', 'education')->name('education');

Route::resource('projects', ProjectController::class);