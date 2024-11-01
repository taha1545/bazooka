<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DriverController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('api.customers.index');
    Route::post('/customers', [CustomerController::class, 'store'])->name('api.customers.store');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('api.customers.show');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('api.customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('api.customers.destroy');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/drivers', [DriverController::class, 'index'])->name('api.drivers.index');
    Route::get('/drivers/{driver}', [DriverController::class, 'show'])->name('api.drivers.show');
});
