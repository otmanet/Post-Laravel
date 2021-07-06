<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('login', [App\Http\Controllers\UserController::class, 'login'])->name('login')->middleware('aleardyLogged');
Route::get('register', [App\Http\Controllers\UserController::class, 'register'])->name('register')->middleware('aleardyLogged');
Route::post('create', [App\Http\Controllers\UserController::class, 'create'])->name('create.user');
Route::post('verify', [App\Http\Controllers\UserController::class, 'verify_auth'])->name('verify.user');
Route::get('post', [App\Http\Controllers\UserController::class, 'post'])->middleware('isLogged');
Route::get('logout',[App\Http\Controllers\UserController::class, 'logout']);
Route::get('createPost', [App\Http\Controllers\UserController::class,
'ceratePost'])->name('create.Post')->middleware('isLogged');
Route::post('AddPost/{id}', [App\Http\Controllers\UserController::class, 'addPost'])->middleware('isLogged');
Route::post('addComment/{id}', [App\Http\Controllers\UserController::class, 'addComment']);