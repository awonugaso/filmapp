<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/purchase', App\Http\Controllers\TransactionController::class);


Route::resource('/film', App\Http\Controllers\FilmController::class);
Route::get('/films', [App\Http\Controllers\FilmController::class, 'films'])->name('film.manage');
Route::post('/search/films', [App\Http\Controllers\FilmController::class, 'search'])->name('purchase-search');

Route::post('/search/customer', [App\Http\Controllers\Auth\UserController::class, 'search'])->name('customer-search');
Route::get('/search/customer', [App\Http\Controllers\Auth\UserController::class, 'search'])->name('customer-search');
Route::get('/customers', [App\Http\Controllers\Auth\UserController::class, 'index'])->name('customers');
Route::get('/history', [App\Http\Controllers\TransactionController::class, 'index'])->name('history');
Route::get('/profile/{user}', [App\Http\Controllers\Auth\UserController::class, 'profile'])->name('profile');
Route::post('/update/profile/{user}', [App\Http\Controllers\Auth\UserController::class, 'update'])->name('profile.update');
Route::post('/profile/{user}', [App\Http\Controllers\Auth\UserController::class, 'password'])->name('password');
