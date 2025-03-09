<?php

namespace App\Http\Controllers;

use App\Models\TempPurchase;
use App\Http\Requests\StoreTempPurchaseRequest;
use App\Http\Requests\UpdateTempPurchaseRequest;
use App\Http\Resources\TempPurchaseResource;

class TempPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return TempPurchaseResource::collection(TempPurchase::paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTempPurchaseRequest $request)
    {
        //
        return new TempPurchaseResource(TempPurchase::create($request->validated()));

    }

    /**
     * Display the specified resource.
     */
    public function show(TempPurchase $tempPurchase)
    {
        //
        return new TempPurchaseResource($tempPurchase);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTempPurchaseRequest $request, TempPurchase $tempPurchase)
    {
        //
        return new TempPurchaseResource(tap($tempPurchase)->update($request->validated()));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TempPurchase $tempPurchase)
    {
        //
        $tempPurchase->delete();
        return response()->json(['message' => 'TempPurchase deleted successfully']);
    }
}
