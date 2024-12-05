<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Middleware\JWTMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([JWTMiddleware::class])->group(function () {
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/authors', AuthorController::class);
    Route::apiResource('/books', BookController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('login', [AuthController::class, 'login']);
