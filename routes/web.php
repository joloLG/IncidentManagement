<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SummaryController;

Route::get('/', function () {
    return response()->json(['data' => \App\Models\Post::latest()->get()]);
});

Route::get('/summary', [SummaryController::class, 'index']);

Route::get('/users', function () {
    return response()->json(['data' => \App\Models\User::latest()->get()]);
});
