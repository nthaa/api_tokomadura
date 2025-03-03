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
        return SaleDetailResource::collection(SaleDetail::paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleDetailRequest $request, $saleId)
    {
        //
        // Tambahkan sale_id ke dalam data validasi sebelum menyimpannya
        $data = array_merge($request->validated(), ['sale_id' => $saleId]);

        // Simpan ke database
        $saleDetail = SaleDetail::create($data);

        // Return sebagai resource
        return new SaleDetailResource($saleDetail);
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleDetail $saleDetail)
    {
        //
        return new SaleDetailResource($saleDetail);
    }

    public function update(UpdateSaleDetailRequest $request, $saleId, $saleDetailId)
    {

        // return new SaleDetailResource(tap($saleDetail)->update($request->validated()));
        $saleDetail = SaleDetail::where('sale_id', $saleId)->findOrFail($saleDetailId);

        $saleDetail->update($request->validated());

        return new SaleDetailResource($saleDetail);
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
