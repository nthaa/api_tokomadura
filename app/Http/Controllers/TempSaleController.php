<?php

namespace App\Http\Controllers;

use App\Models\TempSale;
use App\Http\Requests\StoreTempSaleRequest;
use App\Http\Requests\UpdateTempSaleRequest;
use App\Http\Resources\TempSaleResource;

class TempSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return TempSaleResource::collection(TempSale::paginate(10));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTempSaleRequest $request)
    {
        //
        return new TempSaleResource(TempSale::create($request->validated()));

    }

    /**
     * Display the specified resource.
     */
    public function show(TempSale $tempSale)
    {
        //
        return new TempSaleResource($tempSale);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTempSaleRequest $request, TempSale $tempSale)
    {
        //
        return new TempSaleResource(tap($tempSale)->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TempSale $tempSale)
    {
        //
        $tempSale->delete();
        return response()->json(['message' => 'TempPurchase deleted successfully']);
    }
}
