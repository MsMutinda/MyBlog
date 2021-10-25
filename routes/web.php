<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile routes
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');

Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('profile.edit');

Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile.update');

Route::get('/logout', [App\Http\Controllers\ProfileController::class, 'logout'])->name('logout');


// Blog routes
Route::get('/all-blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.all');

Route::get('/blog/new', [App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');

Route::post('/blog/save', [App\Http\Controllers\BlogController::class, 'store'])->name('blog.save');

Route::get('/blog/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

Route::get('/blog/{id}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');

Route::patch('/blog/{id}/update', [App\Http\Controllers\BlogController::class, 'update'])->name('blog.update');

Route::get('/blog/{id}/archive', [App\Http\Controllers\BlogController::class, 'destroy'])->name('blog.archive');

Route::get('/archives', [App\Http\Controllers\BlogController::class, 'showArchived'])->name('blog.showArchives');

Route::get('/blog/{id}/restore', [App\Http\Controllers\BlogController::class, 'restore'])->name('blog.restore');


// Comments & Replies
Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.add');

Route::post('/reply/store', [App\Http\Controllers\CommentController::class, 'replyStore'])->name('reply.add');

// Like Or Dislike
Route::post('save-likedislike',[App\Http\Controllers\BlogController::class, 'save_likedislike']);

// Blog category filter
Route::get('/categories/{id}',[App\Http\Controllers\HomeController::class, 'filterByCategory'])->name('post-request');

// User roles
Route::get('roles', [App\Http\Controllers\PermissionController::class, 'Permission']);
