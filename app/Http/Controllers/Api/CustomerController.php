<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerCollection;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::with('user')->get();
        return  response(new CustomerCollection($customer),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
{
    $customer = Customer::create($request->json()->all());
    return response()->json(['message' => 'Resource created successfully', 'customer' => $customer], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
{
    return response()->json($customer);
}



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->json()->all());
        return response()->json(['message' => 'Resource updated successfully', 'customer' => $customer]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(['message' => 'Resource deleted successfully']);
    }
    
}
