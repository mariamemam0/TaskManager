<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


//Route::apiResource('projects',\App\Http\Controllers\ProjectController::class);
Route::apiResource('tasks',\App\Http\Controllers\TaskController::class);

Route::apiResource('users',\App\Http\Controllers\UserController::class);

Route::prefix('{type}/{id}/comments')->group(function () {
    Route::get('/',            [\App\Http\Controllers\CommentController::class, 'index']);
    Route::post('/',           [\App\Http\Controllers\CommentController::class, 'store']);
    Route::put('/{comment}',   [\App\Http\Controllers\CommentController::class, 'update']);
    Route::delete('/{comment}',[\App\Http\Controllers\CommentController::class, 'destroy']);
});


Route::post('register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('login',[\App\Http\Controllers\AuthController::class,'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout',   [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::apiResource('projects', \App\Http\Controllers\ProjectController::class);
    Route::get('/me', [\App\Http\Controllers\AuthController::class, 'me']);

});

Route::get('/me', [\App\Http\Controllers\AuthController::class, 'me']);
