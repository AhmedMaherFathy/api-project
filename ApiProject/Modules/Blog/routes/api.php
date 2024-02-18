<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Blog\App\Http\Controllers\api\PostController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
    Route::get('blog', fn (Request $request) => $request->user())->name('blog');
});

Route::get('posts',[PostController::class, 'index']);
Route::get('posts/show/{id}',[PostController::class, 'show']);
Route::post('posts/store',[PostController::class, 'store']);
Route::get('posts/delete/{id}',[PostController::class, 'destroy']);
Route::post('posts/update/{id}',[PostController::class, 'update']);