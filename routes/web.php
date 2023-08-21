<?php

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    Log::info('The client\'s ip address: ' . $request->ip());
    return view('welcome');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/email', function () {
    return view('emails.contacted');
});
Route::post('/contact', [ContactController::class, 'send_mail']);
