<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;
use App\Http\Requests\StoreSaleDetailRequest;
use App\Http\Requests\UpdateSaleDetailRequest;
use App\Http\Resources\SaleDetailResource;

class SaleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
          return SaleDetailResource::collection(SaleDetail::paginate(5));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleDetailRequest $request, $saleId)
    {
        //
        return new SaleDetailResource(SaleDetail::create($request->validated()));

    }

    /**
     * Display the specified resource.
     */
    public function show(SaleDetail $saleDetail)
    {
        //
        return new SaleDetailResource($saleDetail);
    }

    public function update(UpdateSaleDetailRequest $request, SaleDetail $saleDetail)
    {
        return new SaleDetailResource(tap($saleDetail)->update($request->validated()));

        //
        return new SaleDetailResource(tap($saleDetail)->update($request->validated()));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleDetail $saleDetail)
    {
        //
        $saleDetail->delete();
        return response()->json(['message' => 'SaleDetail deleted seccesfully']);
    }
}
