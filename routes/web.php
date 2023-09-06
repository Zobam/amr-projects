<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\WhitelistController;
use App\Http\Middleware\EnsureIpNotBlackListed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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
    // Log::info('The client\'s ip address: ' . $request->ip());
    return view('welcome');
})->middleware(EnsureIpNotBlackListed::class);
Route::get('/contact', function () {
    return view('contact');
})->middleware(EnsureIpNotBlackListed::class);
Route::get('/email', function () {
    return view('emails.contacted');
});
Route::post('/contact', [ContactController::class, 'send_mail']);
Route::get('/_', function () {
    return view('access-denied');
});
Route::get('/whitelist_blocked_ip/{target_ip?}', [WhitelistController::class, 'whitelist']);

Route::get('/send-email', [ContactController::class, 'test_mail']);


//Clear Cache facade value:
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
