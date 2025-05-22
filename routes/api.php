<?php

use App\Http\Controllers\Api\VerifyPassportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('verify_passport', [VerifyPassportController::class, 'verify_passport']);
Route::post('send-verification-link', [VerifyPassportController::class, 'send_verification_link']);
Route::post('check-email', [VerifyPassportController::class, 'check_email']);
