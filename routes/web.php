<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//Route::get('/users', [UserController::class, 'getAll']);
//Route::get('/users/{id}', [UserController::class, 'get']);
//Route::post('/users', [UserController::class, 'create']);
//Route::patch('/users/{id}', [UserController::class, 'update']);
//Route::delete('/users/{id}', [UserController::class, 'delete']);

Route::controller(UserController::class)
    ->group(function () {
        Route::get('/users', 'getAll');
        Route::get('/users/{id}', 'get');
        Route::post('/users', 'create');
        Route::patch('/users/{id}', 'update');
        Route::delete('/users/{id}', 'delete');
    });
