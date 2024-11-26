<?php

namespace App\Http\Controllers\Api;

use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Http\Resources\FoodCollection;
use Illuminate\Http\Request;
use App\Filters\FoodFilter;
use App\Http\Resources\FoodResource;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\Controller;
use App\Models\FoodFile;
use Illuminate\Validation\Rules\Unique;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $filter = new FoodFilter();
        $queryFilters = $filter->transform($request); 
        
        if (count($queryFilters) !== 0) {
            return new FoodCollection(Food::where($queryFilters)->paginate());
        } else {
            return new FoodCollection(Food::paginate());
        }
    }

    public function store(StoreFoodRequest $request)
    {
        try {
            DB::beginTransaction();

            // Create the food item
            $food = Food::create([
                'name' => $request->input('name'),
                'type' => $request->input('type'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'evrg_time' => $request->input('averagetime'),
            ]);


            // store files  (u can do it in queue)
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $path = $file->store('uploads', 'public');
                    FoodFile::create([
                        'food_id' => $food->id,
                        'path' => $path,
                        'name' => $file->getClientOriginalName(),
                        'type' => $file->extension(),
                    ]);
                }
            }
            DB::commit();
             //
            return response()->json([
                'message' => 'Food created successfully',
                'food' => new FoodResource($food),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create food',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function show(Food $food)
    {
        if (!$food) {
            return response()->json(['error' => 'food not found'], 404);
        }
        return response()->json(new FoodResource($food), 200);
    }

    public function update(UpdateFoodRequest $request, Food $food)
    {
        try {
            DB::beginTransaction();

            $food->update([
                'name' => $request->input('name', $food->name),
                'type' => $request->input('type', $food->type),
                'description' => $request->input('description', $food->description),
                'price' => $request->input('price', $food->price),
                'evrg_time' => $request->input('averagetime', $food->evrg_time),
            ]);
             
            DB::commit();

            return response()->json([
                'message' => 'Food updated successfully',
                'food' => new FoodResource($food)
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update food',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Food $food)
    {
        try {
            $food->orders()->detach();
            $food->foodFiles()->delete();
            $food->delete();
            
            return response()->json([
                'message' => 'Food deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete food',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
