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



// create db and models and seeders and factories      done
//create resources and fillters and validation rules   
// create all routes 
//complete all controoler 
// auth
// policies and gates
// cache 
//queue
// enent and brodcasting 
///image upload and send
// secrity and performance 
// api test 
// design front end


Route::get('/', function (){
     return "server is up ....." ;
});