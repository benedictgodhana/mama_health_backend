<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaternalHealthController;
use App\Http\Controllers\ChildHealthController;
use App\Http\Controllers\UltrasoundController;
use App\Http\Controllers\ReferralController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update-phone', [AuthController::class, 'updatePhone']);
    Route::post('/sms/send', [SmsController::class, 'send']);
    Route::get('/tips', [TipController::class, 'index']);
    Route::post('/tips', [TipController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::post('/maternal-records', [MaternalHealthController::class, 'store']);
    Route::post('/child-records', [ChildHealthController::class, 'store']);
    Route::post('/ultrasounds', [UltrasoundController::class, 'store']);
    Route::post('/referrals', [ReferralController::class, 'store']);
});
