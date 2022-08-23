<?php

use Illuminate\Support\Facades\Route;


/**
 * prefic: data
 * namespace: Data
 */


Route::prefix('users')->namespace('Users')->group(function() {
    Route::get('/', [App\Http\Controllers\Data\Users\UsersController::class, 'index']);
    Route::post('/', [App\Http\Controllers\Data\Users\UsersController::class, 'store']);   
});