<?php

use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [RegisterController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/payments', PaymentsController::class);
    Route::post('/payments/{payment}/rectify', [PaymentsController::class, 'rectify']);
    Route::get('/admin/payments', [PaymentsController::class, 'indexAdmin'])
        ->middleware('ability:admin');
});
