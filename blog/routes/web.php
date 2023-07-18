<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
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

Route::get('/', function () { return 'Hello World';});

// Authentication logic
Route::get('register', [RegistrationController::class, 'create'])->name('register');
Route::post('register', [RegistrationController::class, 'store']);
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'showAll'])->name('posts.index');
    Route::get('/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/create', [PostController::class, 'createPost'])->name('post.create');
});


Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::put('/profile', [UserController::class, 'edit'])->name('profile.update');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');

    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
});
