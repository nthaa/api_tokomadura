<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Http\Resources\PurchaseResource;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return PurchaseResource::collection(Purchase::all());
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        //
        return new PurchaseResource(Purchase::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
        return new PurchaseResource($purchase);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
        return new PurchaseResource(tap($purchase)->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
        $purchase->delete();
        return response()->json(['message' => 'Purchase deleted successfully']);
    }
}
