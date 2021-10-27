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

// Route::group(['middleware' => 'web'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// });


// Blog routes
// Authenticated users only
Route::middleware(['web', 'auth'])->group(function()
{
    // Profile routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('view-profile');

    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('edit-profile');

    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('update-profile');

    Route::get('/logout', [App\Http\Controllers\ProfileController::class, 'logout'])->name('logout');

    // Blog routes
    Route::get('/blog/new', [App\Http\Controllers\BlogController::class, 'create'])->name('create-blog');

    Route::post('/blog/save', [App\Http\Controllers\BlogController::class, 'store'])->name('save-blog');

    Route::get('/blog/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('view-blog');

    Route::get('/blog/{id}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('edit-blog');

    Route::patch('/blog/{id}/update', [App\Http\Controllers\BlogController::class, 'update'])->name('update-blog');

    Route::get('/blog/{id}/archive', [App\Http\Controllers\BlogController::class, 'destroy'])->name('archive-blog');

    Route::get('/archives', [App\Http\Controllers\BlogController::class, 'showArchived'])->name('viewBlogArchives');

    Route::get('/blog/{id}/restore', [App\Http\Controllers\BlogController::class, 'restore'])->name('restore-blog');

    // Comments & Replies
    Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('add-comment');

    Route::post('/reply/store', [App\Http\Controllers\CommentController::class, 'replyStore'])->name('add-reply');

    // Like Or Dislike
    Route::post('save-likedislike',[App\Http\Controllers\BlogController::class, 'save_likedislike']);


});


Route::get('/blogs/all', [App\Http\Controllers\BlogController::class, 'index'])->name('viewAllBlogs');


// Blog category filter
Route::get('/blogs/{id}/{name}',[App\Http\Controllers\MainController::class, 'filterByCategory']);

// User roles
// Route::get('roles', [App\Http\Controllers\PermissionController::class, 'Permission']);
