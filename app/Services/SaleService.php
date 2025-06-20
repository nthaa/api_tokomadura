<?php

namespace App\Services;

use App\Models\Product;
use App\Models\TempSale;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaleService
{
    public function checkout($userId)
{
    try {
        $tempSales = TempSale::where('user_id', $userId)->get();

        if ($tempSales->isEmpty()) {
            throw new \Exception('Keranjang kosong');
        }

        $totalHarga = $tempSales->sum(function ($item) {
            return $item->jumlah * $item->harga;
        });

        $sale = Sale::create([
            'user_id' => $userId,
            'total_harga' => $totalHarga,
            'diterima' => 0,
            'kembali' => 0,
            'tanggal' => now()->toDateString(),
            'jam' => now()->toTimeString(),
        ]);

        foreach ($tempSales as $temp) {
            $product = Product::find($temp->product_id);
            if ($product) {
                if ($product->stok < $temp->jumlah) {
                    throw new \Exception("Stok produk {$product->nama_produk} tidak mencukupi.");
                }
                $product->stok -= $temp->jumlah;
                $product->save();
            }

                $sale->saleDetails()->create([
                'product_id' => $temp->product_id,
                'jumlah' => $temp->jumlah,
                'harga_jual_trx' => $temp->harga,
            ]);
        }

        TempSale::where('user_id', $userId)->delete();

        return $sale->load(['saleDetails.product']);
    } catch (\Exception $e) {
        throw new \Exception("Checkout gagal: " . $e->getMessage());
    }
}

}
