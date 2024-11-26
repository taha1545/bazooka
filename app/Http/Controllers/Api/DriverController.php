<?php
namespace App\Http\Controllers\Api;

use App\Filters\DriverFilter;
use App\Models\Driver;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Http\Resources\DriverCollection;
use App\Http\Resources\DriverResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $filter = new DriverFilter();
        $eloquery = $filter->transform($request);

        if(count($eloquery) !== 0){
            return new DriverCollection(Driver::where($eloquery)->paginate());
        } else {
            return new DriverCollection(Driver::paginate());
        }
    }

    public function store(StoreDriverRequest $request)
    {
        try {
            DB::beginTransaction();
            // User create
            $user = User::create([
                'email' => $request->input('email'), 
                'password' => bcrypt($request->input('password')), 
            ]);
            // Driver create
            $driver = Driver::create([
                'id_users' => $user->id,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'is_online'=>false,
                'is_charge'=>false
            ]);
            DB::commit();
            // Return
            return response()->json([
                'message' => 'Driver and associated User created successfully',
                'driver' => new DriverResource($driver)
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create driver and user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Driver $driver)
    {
        if (!$driver) {
            return response()->json(['error' => 'Driver not found'], 404);
        }
        return response()->json(new DriverResource($driver), 200);
    }

    public function update(Request $request, Driver $Driver)
    {
        try {
            DB::beginTransaction();
            //user
            $user = User::findOrFail($Driver->id_users);
    
            if ($request->has('password')) {
                $user->update([
                    'password' => bcrypt($request->input('password')),
                ]);
            }
            // Driver
            $updateData = [];
    
            if ($request->has('name')) {
                $updateData['name'] = $request->input('name');
            }
            if ($request->has('phone')) {
                $updateData['phone'] = $request->input('phone');
            }
            
            if ($request->has('is_online')) {
                $updateData['bonus'] = $request->input('bonus');
            }
            
            if ($request->has('is_charge')) {
                $updateData['is_banned'] = $request->input('isbanned');
            }
            //
            $Driver->update($updateData);
            DB::commit();
            //
            return response()->json([
                'message' => 'Driver and associated User updated successfully',
                'Driver' => new DriverResource($Driver)
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update Driver and user',
                'error' => $e->getMessage()
            ], 500);
        } 
    }

    public function destroy(Driver $driver)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($driver->id_users);
            $driver->delete();
            $user->delete();
            DB::commit();
            return response()->json([
                'message' => 'Driver and associated User deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete driver and user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
