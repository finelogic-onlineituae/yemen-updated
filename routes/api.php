<?php

use App\Http\Controllers\MamoPaymentController;
use Illuminate\Support\Facades\Route;


Route::post('/mamo/webhook', [MamoPaymentController::class, 'handle']);