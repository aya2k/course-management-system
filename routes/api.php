<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\StudentAuthController;
use App\Http\Controllers\Api\TrainerAuthController;

Route::get('/courses', [CourseController::class, 'index']);
//Route::get('/courses/{course}', [CourseController::class, 'show']);


Route::prefix('student')->group(function () {
    Route::post('login', [StudentAuthController::class, 'login']);
    Route::post('register', [StudentAuthController::class, 'register']);

    Route::middleware('auth:api_student')->group(function () {
         Route::post('courses/{course}/enroll', [StudentAuthController::class, 'enroll']);
        Route::get('/my-courses', [StudentAuthController::class, 'myCoursesApi']);
        Route::post('/logout', [StudentAuthController::class, 'logout']);

    });
});


Route::prefix('trainer')->group(function () {
    Route::post('login', [TrainerAuthController::class, 'login']);

    Route::middleware('auth:api_trainer')->group(function () {
        Route::apiResource('courses', CourseController::class);
        Route::apiResource('lessons', LessonController::class);
        Route::post('/logout', [TrainerAuthController::class, 'logout']);
    });
});
