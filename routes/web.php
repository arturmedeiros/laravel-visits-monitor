<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/github/{any}.png', [ApiController::class, 'tracking_github'])->where('any', '.*');

//Route::get('/{any}', [ApiController::class, 'tracking_github'])->where('any', '.*');
