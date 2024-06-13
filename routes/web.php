<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('dashboard');
// });
Route::get('/term', function () {
    return view('term');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::group(['prefix' => 'idea'], function () {
//     Route::post('/post', [IdeaController::class, 'store'])->name('post-idea');
//     Route::get('/{idea}', [IdeaController::class, 'show'])->name('show-idea');
//     Route::get('/{idea}/edit', [IdeaController::class, 'showedit'])->name('edit-idea')->middleware('auth');
//     Route::put('/{idea}/update', [IdeaController::class, 'update'])->name('update-idea')->middleware('auth');
//     Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('delete-idea')->middleware('auth');
//     Route::post('/{idea}/comment', [CommentController::class, 'add_comment'])->name('post-comment')->middleware('auth');
// });

Route::resource('ideas', IdeaController::class)->middleware('auth')->only([
    'create', 'store', 'show', 'edit', 'destroy', 'update'
]);

Route::post('/ideas/{idea}/comment', [CommentController::class, 'add_comment'])->name('ideas.comment')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth')->only([
    'update', 'show', 'edit'
]);
Route::post('user/{user}/follow', [FollowController::class, 'follow'])->name('user.follow')->middleware('auth');
Route::post('user/{user}/unfollow', [FollowController::class, 'unfollow'])->name('user.unfollow')->middleware('auth');
Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');


Route::middleware('auth','can:admin')->prefix('/admin')->as('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/user',[AdminUserController::class,'index'])->name('user');
    Route::get('/idea',[AdminIdeaController::class,'index'])->name('idea');
});
