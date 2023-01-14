<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/tracking/img/{username}/{any}.png', [ApiController::class, 'tracking_github'])->where('any', '.*');
