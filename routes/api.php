<?php

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



use App\Http\Controllers\OrderProductController;

// Route::post('process-data', [OrderProductController::class, 'confirm_order'])->name('process-data');

Route::get('callback',[OrderProductController::class,'paymentCallBack']);
Route::get('error',function(){
    return 'payment failed';
});
