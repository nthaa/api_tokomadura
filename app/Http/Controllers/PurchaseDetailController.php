<?php

namespace App\Http\Controllers;

use App\Models\PurchaseDetail;
use App\Http\Requests\StorePurchaseDetailRequest;
use App\Http\Requests\UpdatePurchaseDetailRequest;
use App\Http\Resources\PurchaseDetailResource;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return PurchaseDetailResource::collection(PurchaseDetail::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseDetailRequest $request)
    {
        //
        return new PurchaseDetailResource(PurchaseDetail::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseDetail $purchaseDetail)
    {
        //
        return new PurchaseDetailResource($purchaseDetail);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseDetailRequest $request, PurchaseDetail $purchaseDetail)
    {
        //
        return new PurchaseDetailResource(tap($purchaseDetail)->update($request->validated()));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseDetail $purchaseDetail)
    {
        //
        $purchaseDetail->delete();
        return response()->json(['message' => 'PurchaseDetail deleted seccesfully']);
    }
}
