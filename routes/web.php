<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Session()->has('admindata')) {
        return redirect()->route('dashboard');
    }
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'show']);
Route::post('/loginprocess', [LoginController::class, 'checklogin']);

Route::get('logout', function () {
    if (Session()->has('admindata')) {
        Session()->forget('admindata');
    }
    return redirect('/login');
})->name('logout');

Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

/////////////////////////////////////// Wifi ///////////////////////////
Route::get('/wifi', [LoginController::class, 'wifishow'])->name('wifishow');
Route::post('/wifisave', [LoginController::class, 'wifisave'])->name('wifisave');
Route::get('/usagedelete/{usage}', [LoginController::class, 'usagedelete'])->name('usagedelete');
