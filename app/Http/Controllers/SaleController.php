<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SaleResource;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return SaleResource::collection(Sale::paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        //
        return new SaleResource(Sale::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
        return new SaleResource($sale);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        //
        return new SaleResource(tap($sale)->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
        $sale->delete();
        return response()->json(['message' => 'Sale deleted successfully']);
    }


    public function getSummary()
    {
        $today = now()->toDateString();

        $totalPenjualan = DB::table('sales')->whereDate('created_at', $today)->sum('total_price');
        $jumlahTransaksi = DB::table('sales')->whereDate('created_at', $today)->count();
        $produkTerjual = DB::table('sale_details')->whereDate('created_at', $today)->sum('quantity');

        return response()->json([
            'total_penjualan' => $totalPenjualan,
            'jumlah_transaksi' => $jumlahTransaksi,
            'produk_terjual' => $produkTerjual
        ]);
    }
}
