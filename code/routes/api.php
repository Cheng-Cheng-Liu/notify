<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotifyController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register'])->name('api.register');
Route::post('login', [LoginController::class, 'login'])->name('api.login');
Route::prefix('back')->middleware('auth:sanctum')->group(function () {
    Route::post('/addNotify', [NotifyController::class, 'addNotify']);
    Route::put('/notify', [NotifyController::class, 'updateNotify']);
    Route::delete('/notify', [NotifyController::class, 'deleteNotify']);
    Route::post('/countUnread', [NotifyController::class, 'countUnresdNotify']);
    Route::get('/myNotifications', [NotifyController::class, 'myNotifications']);
    Route::get('/myNotification', [NotifyController::class, 'myNotification']);
    Route::get('/notification/{id}', [NotifyController::class, 'notification']);
    Route::get('/notificationForupdate/{id}', [NotifyController::class, 'notificationForupdate']);
    Route::get('/allNotifications', [NotifyController::class, 'allNotifications']);
});
Route::post('test', function () {
    return response()->json([
        'message' => 'Registration successful!',
    ], 201);
});
