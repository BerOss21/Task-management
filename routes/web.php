<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
// Route::view('{any}','index')->where('any','.*');
// // Route::view('{any}','app')->where('any','.*');