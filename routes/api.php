<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\PromoCodeController;

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('/promo-codes/activate', [PromoCodeController::class, 'activate']);
    Route::get('/user', function (Request $request) {
        return response()->json(['user_id' => $request->user_id]);
    });
});
