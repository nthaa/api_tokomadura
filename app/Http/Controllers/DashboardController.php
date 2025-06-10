<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    try {
        $totalPendapatan = DB::table('sale_details')->sum('harga_jual_trx') ?? 0;
        $totalPengeluaran = DB::table('purchase_details')->sum('harga_beli') ?? 0;
        $totalSuppliers = DB::table('suppliers')->count() ?? 0;
        $totalProduk = DB::table('products')->count() ?? 0;

        return response()->json([
            'totalPendapatan' => $totalPendapatan,
            'totalPengeluaran' => $totalPengeluaran,
            'totalSuppliers' => $totalSuppliers,
            'totalProduk' => $totalProduk,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Gagal mengambil data dashboard',
            'message' => $e->getMessage(),
        ], 500);
    }
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
