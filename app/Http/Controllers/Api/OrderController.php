<?php

namespace App\Http\Controllers\Api;

use App\Filters\Orderfilter;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    
    public function index(Request $request)
{
    $filter = new OrderFilter();
    $queryConditions = $filter->transform($request);

    if (count($queryConditions) !== 0) {
        return new OrderCollection(Order::where($queryConditions)->paginate());
    } else {
        return new OrderCollection(Order::paginate());
    }
    }


    public function store(StoreOrderRequest $request)
    {
       DB::beginTransaction();
    try {
        // Create the order
        $order =Order::create([
            'id_customer' => $request->input('customer'),
            'id_driver' => 1,  
            'is_cook' => $request->input('iscook'),
            'is_finish' =>  $request->input('isfinish'),
            'location_lat' => "000",
            'location_long' => "000",
        ]);
         //
         $foods = $request->input('foods');
         if ($foods) {
             foreach ($foods as $food) {
                 $order->foods()->attach($food['id'], ['number' => $food['number']]);
             }
         }
         //
        DB::commit();
        //
        return response()->json([
            'message' => 'Order created successfully!',
            'order' =>  new OrderResource($order) ,
        ], 201);
        //
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'message' => 'Failed to create order. Please try again.',
            'error' => $e->getMessage(),
        ], 500);
    }
    }


    public function show(Order $Order)
    {
        if (!$Order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        return response()->json(new OrderResource($Order), 200);
    }

  
    public function update(UpdateOrderRequest $request, Order $order)
{
    try {
        DB::beginTransaction();
        $order->update([
         'id_driver' => $request->input('driver') ?? $order->id_driver,
          'is_cook' => $request->input('iscook') ?? $order->is_cook,
          'is_finish' => $request->input('isfinish') ?? $order->is_finish,
          'location_lat' => $request->input('location_lat') ?? $order->location_lat,
           'location_long' => $request->input('location_long') ?? $order->location_long,

        ]);
        DB::commit();

        return response()->json([
            'message' => 'Order updated successfully!',
            'order' => new OrderResource($order),
        ], 200);

    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'message' => 'Failed to update order. Please try again.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


   
    public function destroy(Order $order)
    {
        try {
            $order->foods()->detach();
            $order->delete();
            
            return response()->json([
                'message' => 'order deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
