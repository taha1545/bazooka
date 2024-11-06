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
                'id_user' => $user->id,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
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

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($driver->id_user);
            $user->update([
                'password' => bcrypt($request->input('password')),
            ]);
            $driver->update([
                'phone' => $request->input('phone'),
                'is_online' => $request->input('is_online'),
                'is_charge' => $request->input('is_charge'),
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Driver and associated User updated successfully',
                'driver' => new DriverResource($driver)
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update driver and user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Driver $driver)
    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($driver->id_user);
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
