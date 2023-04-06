<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Personal\Comment\EditController;
use App\Http\Controllers\Personal\Comment\UpdateController;
use App\Http\Controllers\Personal\Liked\DestroyController;
use App\Http\Controllers\Post\Comment\StoreController;
use App\Http\Controllers\Post\ShowController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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


Route::get('/', IndexController::class)->name('index');
Route::prefix('posts')->group(function (){
    Route::get('/', \App\Http\Controllers\Post\IndexController::class)->name('post.index');
    Route::get('/{post}', ShowController::class)->name('post.index.show');

    Route::prefix('{post}/comments')->group(function (){
        Route::post('/', StoreController::class)->name('post.comment.store');
    });

    Route::prefix('{post}/likes')->group(function (){
        Route::post('/', \App\Http\Controllers\Post\Like\StoreController::class)->name('post.like.store');
    });
});

Route::prefix('categories')->group(function (){
    Route::get('/', \App\Http\Controllers\Category\IndexController::class)->name('category.index');
    Route::get('/{category}', \App\Http\Controllers\Category\ShowController::class)->name('category.index.show');
});

Route::prefix('personal')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', \App\Http\Controllers\Personal\Main\IndexController::class)->name('personal.index');
    Route::prefix('liked')->group(function (){
        Route::get('/', \App\Http\Controllers\Personal\Liked\IndexController::class)->name('personal.liked.index');
        Route::delete('/{post}', DestroyController::class)->name('personal.liked.destroy');
    });
    Route::prefix('comment')->group(function (){
        Route::get('/', \App\Http\Controllers\Personal\Comment\IndexController::class)->name('personal.comment.index');
        Route::delete('/{comment}', \App\Http\Controllers\Personal\Comment\DestroyController::class)->name('personal.comment.destroy');
        Route::get('/{comment}/edit', EditController::class)->name('personal.comment.edit');
        Route::patch('/{comment}', UpdateController::class)->name('personal.comment.update');
    });
});


Route::prefix('admin')->middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/', \App\Http\Controllers\Admin\Main\IndexController::class)->name('admin.index');
    Route::prefix('category')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Category\IndexController::class)->name('admin.category.index');
        Route::get('/create', \App\Http\Controllers\Admin\Category\CreateController::class)->name('admin.category.create');
        Route::post('/', \App\Http\Controllers\Admin\Category\StoreController::class)->name('admin.category.store');
        Route::get('/{category}', \App\Http\Controllers\Admin\Category\ShowController::class)->name('admin.category.show');
        Route::get('/{category}/edit', \App\Http\Controllers\Admin\Category\EditController::class)->name('admin.category.edit');
        Route::patch('/{category}', \App\Http\Controllers\Admin\Category\UpdateController::class)->name('admin.category.update');
        Route::delete('/{category}', \App\Http\Controllers\Admin\Category\DestroyController::class)->name('admin.category.destroy');
    });

    Route::prefix('tag')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Tag\IndexController::class)->name('admin.tag.index');
        Route::get('/create', \App\Http\Controllers\Admin\Tag\CreateController::class)->name('admin.tag.create');
        Route::post('/', \App\Http\Controllers\Admin\Tag\StoreController::class)->name('admin.tag.store');
        Route::get('/{tag}', \App\Http\Controllers\Admin\Tag\ShowController::class)->name('admin.tag.show');
        Route::get('/{tag}/edit', \App\Http\Controllers\Admin\Tag\EditController::class)->name('admin.tag.edit');
        Route::patch('/{tag}', \App\Http\Controllers\Admin\Tag\UpdateController::class)->name('admin.tag.update');
        Route::delete('/{tag}', \App\Http\Controllers\Admin\Tag\DestroyController::class)->name('admin.tag.destroy');
    });

    Route::prefix('post')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Post\IndexController::class)->name('admin.post.index');
        Route::get('/create', \App\Http\Controllers\Admin\Post\CreateController::class)->name('admin.post.create');
        Route::post('/', \App\Http\Controllers\Admin\Post\StoreController::class)->name('admin.post.store');
        Route::get('/{post}', \App\Http\Controllers\Admin\Post\ShowController::class)->name('admin.post.show');
        Route::get('/{post}/edit', \App\Http\Controllers\Admin\Post\EditController::class)->name('admin.post.edit');
        Route::patch('/{post}', \App\Http\Controllers\Admin\Post\UpdateController::class)->name('admin.post.update');
        Route::delete('/{post}', \App\Http\Controllers\Admin\Post\DestroyController::class)->name('admin.post.destroy');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\User\IndexController::class)->name('admin.user.index');
        Route::get('/create', \App\Http\Controllers\Admin\User\CreateController::class)->name('admin.user.create');
        Route::post('/', \App\Http\Controllers\Admin\User\StoreController::class)->name('admin.user.store');
        Route::get('/{user}', \App\Http\Controllers\Admin\User\ShowController::class)->name('admin.user.show');
        Route::get('/{user}/edit', \App\Http\Controllers\Admin\User\EditController::class)->name('admin.user.edit');
        Route::patch('/{user}', \App\Http\Controllers\Admin\User\UpdateController::class)->name('admin.user.update');
        Route::delete('/{user}', \App\Http\Controllers\Admin\User\DestroyController::class)->name('admin.user.destroy');
    });
})->middleware('admin');

Route::controller(AuthController::class)->middleware('guest')->group(function () {

    Route::get('/login', 'showLogin')->name('login');
    Route::get('/register', 'showRegister')->name('register');

    Route::post('/login_process', 'login')->name('login_process');
    Route::post('/register_process', 'register')->name('register_process');

    Route::post('/forgot_process', [AuthController::class, 'forgot'])->name('forgot_process');
    Route::get('/forgot', [AuthController::class, 'showForgot'])->name('forgot');

});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    if (Auth::user()->role === User::ROLE_ADMIN) {
        return redirect(\route('admin.index'));
    }
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


