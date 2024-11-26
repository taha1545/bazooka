<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Resources\FoodCollection;
use App\Http\Resources\FoodResource;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\food;
use App\Models\FoodFile;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Customer;




// auth                   
// policies and gates
// cache 
//queue
// enent and brodcasting 
// secrity and performance  



Route::get('/', function (){
       return  "full api server";
});


