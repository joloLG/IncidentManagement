<?php

use App\Http\Controllers\API\IncidentController;
use App\Http\Controllers\API\IncidentTypeController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('posts', PostController::class)->only(['index', 'store', 'show', 'destroy']);
Route::apiResource('incident-types', IncidentTypeController::class)->only(['index', 'show']);
Route::apiResource('incidents', IncidentController::class)->only(['index', 'show']);
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    
    Route::apiResource('users', UserController::class);
    Route::apiResource('incident-types', IncidentTypeController::class)->except(['index', 'show']);
    Route::apiResource('incidents', IncidentController::class)->except(['index', 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});