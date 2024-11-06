<?php
namespace App\Http\Controllers\Api;


use App\Filters\Customerfilter;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class CustomerController extends Controller
{
 
//
    public function index(Request $request)
    {
         $filter=new Customerfilter();
         $eloquery=$filter->transform($request);
        //
         if(count($eloquery) !== 0){
            return new CustomerCollection(Customer::where($eloquery)->paginate());
         }else{
            return new CustomerCollection(Customer::paginate());
         }
    }
//
    public function store(StoreCustomerRequest $request)
    {
        try {
            DB::beginTransaction();
            //user create
            $user = User::create([
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')), 
            ]);
            // customer create
            $customer = Customer::create([
                'id_user' => $user->id,
                'name'=>$request->input('name'),
                'phone' => $request->input('phone'),
            ]);
            DB::commit();
            //return
            return response()->json([
                'message' => 'Customer and associated User created successfully',
                'customer' =>new CustomerResource($customer)
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            //
            return response()->json([
                'message' => 'Failed to create customer and user',
                'error' => $e->getMessage()
            ], 500);
        }}
//    
        public function show(Customer $customer)
        {
            if (!$customer) {
                return response()->json(['error' => 'Customer not found'], 404);
            }
            return response()->json(new CustomerResource($customer), 200);
        }
        
//
        public function update(UpdateCustomerRequest $request,Customer $customer )
        {
            try {
                DB::beginTransaction();
                $customer = Customer::findOrFail($customer);
                //
                $user = User::findOrFail($customer->id_user);
                $user->update([
                    'password' => bcrypt($request->input('password')),
                ]);
                //
                $customer->update([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                ]);
                DB::commit();
                return response()->json([
                    'message' => 'Customer and associated User updated successfully',
                    'customer' => new CustomerResource($customer)
                ], 200);
                //
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Failed to update customer and user',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
        
 //         
        public function destroy(Customer $customer)
        {
            try {
                DB::beginTransaction();
                //
                $customer = Customer::findOrFail($customer);
                $user = User::findOrFail($customer->id_user);
                //
                $customer->delete();
                $user->delete();
                //
                DB::commit();
                return response()->json([
                    'message' => 'Customer and associated User deleted successfully'
                ], 200);
                //
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Failed to delete customer and user',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
        
    
}
