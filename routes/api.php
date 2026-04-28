<?php

use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/complaints', ComplaintsController::class)
        ->only(['index', 'store', 'show']);
    Route::post('/admin/complaints/{complaint}/resolve', [ComplaintsController::class, 'resolve'])
        ->middleware('ability:admin');
    Route::get('/admin/complaints', [ComplaintsController::class, 'indexAdmin'])
        ->middleware('ability:admin');
    Route::apiResource('/payments', PaymentsController::class)
        ->only(['index', 'store', 'show']);
    Route::post('/payments/{payment}/rectify', [PaymentsController::class, 'rectify']);
    Route::get('/admin/payments', [PaymentsController::class, 'indexAdmin'])
        ->middleware('ability:admin');
});
