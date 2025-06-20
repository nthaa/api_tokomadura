<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SaleResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SaleResource::collection(Sale::with('saleDetails')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {

        return DB::transaction(function () use ($request) {
            // Simpan data sale utama
            $sale = Sale::create([

                'user_id' => Auth::id(),
                'total_harga' => $request->total_harga,
                'diterima' => $request->diterima,
                'kembali' => $request->kembali,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);

            // Simpan detail penjualan dan kurangi stok
            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);

                if (!$product) {
                    throw new \Exception("Produk dengan ID {$item['product_id']} tidak ditemukan.");
                }

                if ($product->stok < $item['jumlah']) {
                    throw new \Exception("Stok tidak cukup untuk produk: " . ($product->nama_produk ?? 'Tidak diketahui') . ".");
                }

                // Kurangi stok
                $product->stok -= $item['jumlah'];
                $product->save();

                // Simpan sale detail
                $sale->saleDetails()->create([
                    'product_id' => $item['product_id'],
                    'jumlah' => $item['jumlah'],
                    'harga_jual_trx' => $item['harga_jual_trx'],
                    'total' => $item['jumlah'] * $item['harga_jual_trx'],
                ]);
            }

            return response()->json(['data' => new SaleResource($sale->load('saleDetails'))
        ]);

        });
    }


    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return new SaleResource($sale->load('saleDetails'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        $sale->update($request->only([
            'total_harga',
            'diterima',
            'kembali',
            'tanggal',
            'jam'
        ]));

        // Jika mau update sale_details, tambahkan logika di sini

        return new SaleResource($sale->load('saleDetails'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response()->json(['message' => 'Sale deleted successfully']);
    }
}
