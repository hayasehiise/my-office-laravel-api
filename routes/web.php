<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'laravel' => 11,
        'data' => 'testing API'
    ], 200);
});

require __DIR__.'/auth.php';
