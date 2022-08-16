<?php

use Illuminate\Support\Facades\Auth;
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

// * Disebaling register routes .. Then delete the RegisterController
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Routes will only be accesible if your authenticated
Route::prefix('users')->namespace('Users')->name('users.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\Users\UsersController::class, 'index'])->name('dashboard');
});

// Data router
Route::prefix('data')->namespace('Data')->middleware('web', 'auth')->group(base_path('routes/web/data.php'));
