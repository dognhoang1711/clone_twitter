<?php

use App\Http\Controllers\Admin\AuthorizationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\User_Role_PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Spatie\Permission\Contracts\Permission;

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
    'create',
    'store',
    'show',
    'edit',
    'destroy',
    'update'
]);

Route::post('/ideas/{idea}/comment', [CommentController::class, 'add_comment'])->name('ideas.comment')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth')->only([
    'update',
    'show',
    'edit'
]);

Route::post('user/{user}/follow', [FollowController::class, 'follow'])->name('user.follow')->middleware('auth');
Route::post('user/{user}/unfollow', [FollowController::class, 'unfollow'])->name('user.unfollow')->middleware('auth');
Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');


// Route::middleware('auth', 'can:admin')->prefix('/admin')->as('admin.')->group(function () {
//     Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
//     Route::get('/user', [AdminUserController::class, 'index'])->name('user');
//     Route::get('/idea', [AdminIdeaController::class, 'index'])->name('idea');
// });


//route add quyen cho tai khoản
Route::get('/admin-authorize', [AuthorizationController::class, 'load'])->name('admin.authorize');
Route::post('/admin-authorize', [AuthorizationController::class, 'AddAuthor'])->name('admin.authorize.post');

//show form nhập email
Route::get('/forgot-password', function () {
    return view('auth.forgot');
})->middleware('guest')->name('password.request');

//gửi mail
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
//show form nhập lại mat khau
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.change_pass', ['token' => $token]);
})->middleware('guest')->name('password.reset');


//updatepass
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('user', User_Role_PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::get('role/{id}/permission', [RoleController::class, 'add_permission'])->name('add_permission');
    Route::put('role/{id}/permission', [RoleController::class, 'givepermission_to_Role'])->name('add_permission_to_role');
});

