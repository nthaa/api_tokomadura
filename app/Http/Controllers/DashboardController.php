<?php

namespace App\Http\Controllers;

use App\Http\Resources\DashboardResource;
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
            $summary = (object) [
                'total_pendapatan' => DB::table('sale_details')->sum('harga_jual_trx') ?? 0,
                'total_pengeluaran' => DB::table('purchase_details')->sum('harga_beli') ?? 0,
                'total_suppliers' => DB::table('suppliers')->count() ?? 0,
                'total_products' => DB::table('products')->count() ?? 0,
            ];

            return new DashboardResource($summary);
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
