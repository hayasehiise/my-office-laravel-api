<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LowonganController;
use App\Http\Controllers\Api\WebinarController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/lowongan', LowonganController::class)->parameters(['lowongan' => 'dataLowongan']);
Route::apiResource('/webinar', WebinarController::class)->parameters(['webinar' => 'dataWebinar']);
