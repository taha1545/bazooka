<?php

namespace App\Http\Controllers\Api;

use App\Models\food_file;
use App\Http\Requests\Storefood_fileRequest;
use App\Http\Requests\Updatefood_fileRequest;
use App\Models\FoodFile;

class FoodFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storefood_fileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodFile $food_file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodFile $food_file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatefood_fileRequest $request, FoodFile $food_file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodFile $food_file)
    {
        //
    }
}
