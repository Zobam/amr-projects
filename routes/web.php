<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\WhitelistController;
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
});
Route::get('/intro', function () {
    return view('intro');
});
Route::get('/case-study', function () {
    return view('case-study');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/email', function () {
    return view('emails.contacted');
});
Route::post('/contact', [ContactController::class, 'send_mail']);
Route::get('/_', function () {
    return view('access-denied');
});
Route::get('/whitelist_blocked_ip/{target_ip?}', [WhitelistController::class, 'whitelist']);

Route::get('/send-email', [ContactController::class, 'test_mail']);
Route::get('/email/verify/{token}', [ContactController::class, 'verify_email']);
Route::post('/email/verify', [ContactController::class, 'authorize_email']);
Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/')->with('success', 'Logged out successfully');
})->middleware('auth')->name('logout');

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
