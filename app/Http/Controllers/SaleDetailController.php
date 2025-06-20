<?php

namespace App\Http\Controllers;

use App\Models\SaleDetail;
use App\Models\Product;
use App\Http\Requests\StoreSaleDetailRequest;
use App\Http\Requests\UpdateSaleDetailRequest;
use App\Http\Resources\SaleDetailResource;
use Illuminate\Http\JsonResponse;

class SaleDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SaleDetailResource::collection(SaleDetail::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleDetailRequest $request)
    {
        $validated = $request->validated();

        $product = Product::find($validated['product_id']);

        if (!$product) {
            return response()->json([
                'message' => 'Produk tidak ditemukan.'
            ], 404);
        }

        if ($product->jumlah < $validated['jumlah']) {
            return response()->json([
                'message' => 'Stok produk tidak mencukupi.'
            ], 422);
        }

        // Kurangi stok
        $product->jumlah -= $validated['jumlah'];
        $product->save();

        $saleDetail = SaleDetail::create($validated);

        return new SaleDetailResource($saleDetail);
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleDetail $saleDetail)
    {
        return new SaleDetailResource($saleDetail);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleDetailRequest $request, SaleDetail $saleDetail)
    {
        $validated = $request->validated();

        // Kalau jumlah diubah, hitung selisih stok
        if (isset($validated['jumlah'])) {
            $product = Product::find($saleDetail->product_id);
            $selisih = $validated['jumlah'] - $saleDetail->jumlah;

            if ($product->jumlah < $selisih) {
                return response()->json([
                    'message' => 'Stok produk tidak mencukupi untuk update.'
                ], 422);
            }

            $product->jumlah -= $selisih;
            $product->save();
        }

        $saleDetail->update($validated);

        return new SaleDetailResource($saleDetail);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleDetail $saleDetail)
    {
        // Tambahkan stok kembali saat detail dihapus
        $product = Product::find($saleDetail->product_id);
        if ($product) {
            $product->jumlah += $saleDetail->jumlah;
            $product->save();
        }

        $saleDetail->delete();

        return response()->json(['message' => 'SaleDetail deleted successfully']);
    }
}
