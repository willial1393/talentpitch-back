<?php

use App\Http\Middleware\BasicAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::middleware(BasicAuthMiddleware::class)->group(function () {
    Route::get('/api', function () {
        return response()->json(['hello' => 'world']);
    });
});
