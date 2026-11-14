<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;

// Home
Route::get('/', [PageController::class, 'home'])
    ->name('home');

// Students
Route::resource('students', StudentController::class);

// About
Route::get('/about', [PageController::class, 'about'])
    ->name('about');

// Contact
Route::get('/contact', [PageController::class, 'contact'])
    ->name('contact');
