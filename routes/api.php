<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\OrderController;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;

  Route::apiResource('customer',CustomerController::class);

  Route::apiResource('driver',DriverController::class);

  Route::apiResource('food',FoodController::class);

  Route::apiResource('order',OrderController::class);

     

  
  





  //{{bann , get_bonus}}
  //{{is_charge(order),is_online}}
 //adddriver,is_cokked,is_finish
