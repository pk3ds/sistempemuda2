<?php

// use App\Http\Controllers\API\AuthController\AuthController;
// use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('test', function (Request $request) {
//     return 'test';
// });
Route::get('login', [AuthController::class, 'signin'])->name('auth.signin');

Route::get('test', function (Request $request) {
    return 'trying to login';
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [ApiUserController::class, 'index'])->name('users');
    Route::get('test', function (Request $request) {
        return 'trying to login';
    });
});

Route::middleware('auth', 'role:Admin')->group(function () {
    Route::get('testt', function (Request $request) {
        return 'trying to login';
    });
    // Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{user}/reset', [UserController::class, 'reset'])->name('users.reset');
    Route::put('/users/{user}/points', [UserController::class, 'points'])->name('users.points');

    Route::get('/sessions', [MeetingController::class, 'index'])->name('sessions');
    Route::get('/sessions/create', [MeetingController::class, 'create'])->name('sessions.create');
    Route::post('/sessions', [MeetingController::class, 'store'])->name('sessions.store');
    Route::get('/sessions/{meeting}/edit', [MeetingController::class, 'edit'])->name('sessions.edit');
    Route::patch('/sessions/{meeting}', [MeetingController::class, 'update'])->name('sessions.update');
    Route::delete('/sessions/{meeting}/delete', [MeetingController::class, 'destroy'])->name('sessions.destroy');
});