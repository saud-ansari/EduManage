<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;

// Trash Routes

Route::get('/students/trash', [StudentController::class, 'trashed'])
    ->name('students.trash');

Route::patch('/students/{id}/restore', [StudentController::class, 'restore'])
    ->name('students.restore');

Route::delete('/students/{id}/force-delete', [StudentController::class, 'forceDelete'])
    ->name('students.forceDelete');

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


