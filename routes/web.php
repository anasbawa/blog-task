<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardControllre;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('front.home');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'dashboard',
],function() {
    route::get('/', [DashboardControllre::class, 'index']);
    route::get('/posts', [DashboardControllre::class, 'showPosts'])->name('dashboard.posts');
    route::get('/comments', [DashboardControllre::class, 'showComments'])->name('dashboard.comments');
    route::get('/comments/trashed', [CommentsController::class, 'trash'])->name('comments.trashed');
    route::get('/posts/trashed', [PostsController::class, 'trash'])->name('posts.trashed');

    route::delete('posts/{post}/force-delete', [PostsController::class, 'forceDelete'])
        ->name('posts.force-delete');
    route::delete('comments/{comment}/force-delete', [CommentsController::class, 'forceDelete'])
    ->name('comments.force-delete');

    route::put('posts/{post}/restore', [PostsController::class, 'restore'])
        ->name('posts.restore');
    route::put('comments/{comment}/restore', [CommentsController::class, 'restore'])
        ->name('comments.restore');
});

Route::get('/dashboard', function() {
    return view('front.dashboard');
})->middleware('auth')->name('dashboard');

Route::resource('posts', PostsController::class);
Route::resource('comments', CommentsController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

route::fallback(function() {
    return view('404');
});
