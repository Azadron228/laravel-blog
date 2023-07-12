<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {return 'Hello World';});

Route::get('/posts', [PostController::class, 'index'])->name('home');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('getPostById');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('DeletePost');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('UpdatePost');
Route::post('/posts', [PostController::class, 'store'])->name('CreatePost');

Route::get('/comments', [CommentController::class, 'index'])->name('getAllComments');

Route::get('/profile', function () {return 'Hello admin';})->name('profile')->middleware('auth');

Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
