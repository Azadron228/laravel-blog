<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;

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
    return 'Hello World';
});

Route::get('register', [RegistrationController::class, 'create'])->name('register');
Route::post('register', [RegistrationController::class, 'store']);
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store']);

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    Route::put('/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
  Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
  Route::get('/profile', [UserController::class, 'profile'])->name('profile');
  
});
Route::post('/users/update-avatar', [UserController::class, 'updateAvatar'])->name('users.updateAvatar');
Route::get('/update-avatar', [UserController::class, 'showUpdateAvatarForm'])->name('update.avatar.form');
Route::post('/update-avatar', [UserController::class, 'updateAvatar'])->name('update.avatar');

// Route::get('/login', [LoginController::class, 'show'])->name('login');
// Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::get('/file', function () {
    return response()->download(storage_path('app/jojo.jpg'));
});

// Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);
//
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
//
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
