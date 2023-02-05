<?php

use App\Http\Controllers\EventController;
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

Auth::routes();
    //Route::get('events', [\App\Http\Controllers\EventController::class, 'create'])->name('events.create');
    //Route::post('events/create', [\App\Http\Controllers\EventController::class, 'store'])->name('events.create');  

    //Route::get('/search'. 'EventController@search');
    //Route::get('search', [\App\Http\Controllers\EventController::class, 'search'])->name('events.index');


    Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::view('about', 'about')->name('about');

    Route::resource('events', EventController::class);
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');    
});
