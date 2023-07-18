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

Route::get('/', function () {
    return 'Hello World';
});

// Authentication logic

Route::get('register', [RegistrationController::class, 'create'])->name('register');
Route::post('register', [RegistrationController::class, 'store']);
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/{id}', [PostController::class, 'show'])->name('posts.show');
    // Route::post('/', [PostController::class, 'store'])->name('posts.store');
    // Route::put('/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');

Route::get('/users', function () {
    return User::paginate();
});
Route::get('/posts', function () {
    $posts = Post::with('user')->paginate(10);

    foreach ($posts as $post) {
        $post->user_name = $post->user->name;
    }

    // $totalPages = $postsPaginated->lastPage();

    $data = [
        'current_page' => $posts->currentPage(),
        'total_pages' => $posts->lastPage(),
        'data' => $posts->items(),
    ];

    return response()->json($data, Response::HTTP_OK);

});
Route::get('/profile/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::get('/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/my-posts', [PostController::class, 'store'])->name('posts.store');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    //Route::post('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::put('/profile', [UserController::class, 'edit'])->name('profile.update');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');

    Route::get('/posts/{id}/edit', 'PostController@edit')->name('posts.edit');
    Route::put('/posts/{id}', 'PostController@update')->name('posts.update');

});
