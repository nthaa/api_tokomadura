<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Http\Resources\SaleResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $query = Sale::with(['saleDetails.product', 'user']);

    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
    }

    if ($request->filled('kasir')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->kasir . '%');
        });
    }

    $sales = $query->orderByDesc('created_at')->paginate(10);

    return SaleResource::collection($sales);
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
    return new SaleResource($sale->load('saleDetails.product'));    }

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
