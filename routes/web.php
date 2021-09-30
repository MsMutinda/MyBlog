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
Route::get('/blog/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');

Route::post('/blog/save', [App\Http\Controllers\BlogController::class, 'store'])->name('blog.save');

Route::get('/blog/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

Route::get('/blog/{id}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');

Route::patch('/blog/{id}/update', [App\Http\Controllers\BlogController::class, 'update'])->name('blog.update');

Route::delete('/blog/{id}/archive', [App\Http\Controllers\BlogController::class, 'destroy'])->name('blog.archive');

Route::get('/archives', [App\Http\Controllers\BlogController::class, 'showArchived'])->name('blog.archives');

Route::patch('/blog/{id}/restore', [App\Http\Controllers\BlogController::class, 'restore'])->name('blog.restore');
