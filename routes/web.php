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

Route::group(['middleware' => 'web'], function () 
{
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('save-subscriber', [App\Http\Controllers\HomeController::class, 'saveSubscriber'])->name('save-subscriber');

    // Blog category filter
    Route::get('/categories/{id}/{name}',[App\Http\Controllers\HomeController::class, 'filterByCategory']);
});


// Authenticated users only
Route::middleware('auth')->group(function() 
{
    // Profile routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('view-profile');

    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('edit-profile');

    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('update-profile');

    Route::get('/logout', [App\Http\Controllers\ProfileController::class, 'logout'])->name('logout');

    Route::get('/blog/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('view-blog');

    // Add Comments/Replies
    Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('add-comment');
    Route::post('/reply/store', [App\Http\Controllers\CommentController::class, 'replyStore'])->name('add-reply');

    // Like Or Dislike Blog
    Route::post('save-likedislike', [App\Http\Controllers\BlogController::class, 'save_likedislike']);

    // Like Or Dislike Comment/Reply
    Route::post('like-comment', [App\Http\Controllers\CommentController::class, 'like_comment']);


});


Route::middleware('auth', 'role')->group(function()
{
    // Blog routes
    Route::post('/blog/save', [App\Http\Controllers\BlogController::class, 'store'])->name('save-blog');

    // Route::match(['get', 'post'], '/blog/{id}', ['uses' => '\App\Http\Controllers\HomeController@show', 'as' => 'view-blog']);


    Route::get('/blog/{id}/comments', [App\Http\Controllers\BlogController::class, 'showComments'])->name('view-blogComments');

    Route::get('/blog/{id}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('edit-blog');

    Route::patch('/blog/{id}/update', [App\Http\Controllers\BlogController::class, 'update'])->name('update-blog');

    Route::get('/blog/{id}/archive', [App\Http\Controllers\BlogController::class, 'destroy'])->name('archive-blog');

    Route::get('/archives', [App\Http\Controllers\BlogController::class, 'showArchived'])->name('viewBlogArchives');

    Route::get('/blog/{id}/restore', [App\Http\Controllers\BlogController::class, 'restore'])->name('restore-blog');

    Route::post('publish-blog', [App\Http\Controllers\BlogController::class, 'publish_blog'])->name('publish-blog');

    Route::post('approve-comment', [App\Http\Controllers\CommentController::class, 'approve_comment'])->name('approve-comment');

    Route::get('/blogs/all', [App\Http\Controllers\BlogController::class, 'index'])->name('viewAllBlogs');

});


// Route::match(['get', 'post'], 'save-subscriber', ['uses' => '\App\Http\Controllers\HomeController@saveSubscriber', 'as' => 'save-subscriber']);

