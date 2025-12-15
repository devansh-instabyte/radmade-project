<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', [PageApiController::class, 'homepage']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
