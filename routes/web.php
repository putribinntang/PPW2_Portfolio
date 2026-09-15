<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/about', 'about')->name('about');

Route::view('/education', 'education')->name('education');

Route::view('/projects', 'projects')->name('projects');