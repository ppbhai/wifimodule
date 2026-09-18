<?php

use App\Http\Controllers\UsageController;
use Illuminate\Support\Facades\Route;

// Submit a usage record. Only `password` is sent by the client;
// the name is copied from the admin's stored wifiname.
Route::post('/usage', [UsageController::class, 'store']);
