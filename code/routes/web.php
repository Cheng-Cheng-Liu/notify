<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('login');
})->name("login");

Route::prefix('back')->group(function () {
    Route::get('/', function () {
        return view('back.index');
    })->name('back.index');
    Route::get('/notifies', function () {
        return view('back.notifies');
    });
    Route::get('/addNotify', function () {
        return view('back.addNotify');
    });
    Route::get('/myNotifications', function () {
        return view('back.myNotifications');
    });
    Route::get('/notification/{id}', function ($id) {
        return view('back.notification', ['id' => $id]);
    });
});
