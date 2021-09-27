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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


// Profile routes
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');

Route::get('/editProfile', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name('profile-edit');

Route::put('/updateProfile', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile-update');

// Blog routes
Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs');
