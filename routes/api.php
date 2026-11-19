<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StudentController;


// Public API login
Route::post('/login', [AuthController::class, 'login']);


// Protected API routes
Route::middleware('auth:sanctum')->group(function () {

    // Admin and Staff permissions
    Route::middleware('role:admin,staff')->group(function () {

        Route::apiResource('students', StudentController::class)
            ->except('destroy');

    });

    // Admin-only deletion
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])
        ->middleware('role:admin');


    // API logout
    Route::post('/logout', function (Request $request) {

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);

    });

});
