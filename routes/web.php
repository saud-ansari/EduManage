<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

// Home
Route::get('/', [PageController::class, 'home'])
    ->name('home');

// About
Route::get('/about', [PageController::class, 'about'])
    ->name('about');

// Contact
Route::get('/contact', [PageController::class, 'contact'])
    ->name('contact');


// Guest Routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1');

});


// Authenticated Routes
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // Admin and Staff Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })
        ->middleware('role:admin,staff')
        ->name('dashboard');

    // Admin Only - Trash Route (register before students/{student})
    Route::middleware('role:admin')->group(function () {

        Route::get('/students/trash', [StudentController::class, 'trashed'])
            ->name('students.trash');

        Route::patch('/students/{id}/restore', [StudentController::class, 'restore'])
            ->name('students.restore');

        Route::delete('/students/{id}/force-delete', [StudentController::class, 'forceDelete'])
            ->name('students.forceDelete');

    });

    // Admin and Staff
    Route::middleware('role:admin,staff')->group(function () {

        Route::resource('students', StudentController::class)
            ->only([
                'index',
                'create',
                'store',
                'show',
                'edit',
                'update',
            ]);
    });


    // Admin Only
    Route::middleware('role:admin')->group(function () {

        Route::resource('students', StudentController::class)
            ->only(['destroy']);

    });


    // Admin Only - Student and Teacher Account Creation
    Route::middleware('role:admin')
        ->prefix('admin/accounts')
        ->name('admin.accounts.')
        ->group(function () {

            // Student Accounts
            Route::get('/students', [AccountController::class, 'students'])
                ->name('students');

            Route::post('/students', [AccountController::class, 'storeStudent'])
                ->name('students.store');


            // Teacher Accounts
            Route::get('/teachers', [AccountController::class, 'teachers'])
                ->name('teachers');

            Route::post('/teachers', [AccountController::class, 'storeTeacher'])
                ->name('teachers.store');

        });


    // Student Profile
    Route::middleware('role:student')->group(function () {

        Route::get('/my-profile', function () {

            $student = auth()->user()
                ->student()
                ->with('courseDetails.teacher')
                ->firstOrFail();

            return view('students.profile', compact('student'));

        })->name('student.profile');

    });


    // Teacher Dashboard
    Route::middleware('role:teacher')->group(function () {

        Route::get('/teacher/dashboard', function () {

            $teacher = auth()->user()
                ->teacher()
                ->with('courses.students')
                ->firstOrFail();

            return view('teacher.dashboard', compact('teacher'));

        })->name('teacher.dashboard');

    });

});


