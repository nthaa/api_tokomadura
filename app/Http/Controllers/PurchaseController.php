<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Http\Resources\PurchaseResource;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Purchase::with(['supplier', 'purchaseDetails.product']);

    if ($request->has('search')) {
        $search = $request->search;
        $query->whereHas('supplier', function ($q) use ($search) {
            $q->where('nama', 'like', "%$search%");
        });
    }

    $sortBy = $request->get('sort_by', 'created_at');
    $sortOrder = $request->get('sort_order', 'desc');

    $allowedSorts = ['tanggal', 'created_at', 'total', 'supplier_nama'];

    if (in_array($sortBy, $allowedSorts)) {
        if ($sortBy === 'supplier_nama') {
            $query->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
                  ->orderBy('suppliers.nama', $sortOrder)
                  ->select('purchases.*');
        } elseif ($sortBy === 'total') {
            $query->withSum('purchaseDetails as total_harga', 'total')
                  ->orderBy('total_harga', $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }
    } else {
        // default sort by waktu terbaru
        $query->orderByDesc('created_at');
    }

    return PurchaseResource::collection($query->paginate(10));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'tanggal' => now()->toDateString(),
                'jam' => now()->toTimeString(),
            ]);

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                if (!$product) {
                    throw new \Exception("Produk dengan ID {$item['product_id']} tidak ditemukan.");
                }

                $product->stok += $item['jumlah'];
                $product->harga_beli = $item['harga_beli'];
                $product->save();

                $purchase->purchaseDetails()->create([
                    'product_id' => $item['product_id'],
                    'harga_beli' => $item['harga_beli'],
                    'jumlah' => $item['jumlah'],
                    'total' => $item['harga_beli'] * $item['jumlah'],
                ]);
            }

            return response()->json([
                'data' => new PurchaseResource($purchase->load(['purchaseDetails.product', 'supplier']))
            ], 201);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return new PurchaseResource($purchase->load(['purchaseDetails.product', 'supplier']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        return DB::transaction(function () use ($request, $purchase) {
            foreach ($purchase->purchaseDetails as $detail) {
                $product = Product::find($detail->product_id);
                if ($product && $product->stok < $detail->jumlah) {
                    throw new \Exception("Stok produk '{$product->nama_produk}' tidak cukup untuk rollback. Sisa: {$product->stok}, butuh kurangi: {$detail->jumlah}");
                }
            }

            foreach ($purchase->purchaseDetails as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->stok -= $detail->jumlah;
                    $product->save();
                }
            }

            $purchase->purchaseDetails()->delete();

            $purchase->update([
                'supplier_id' => $request->supplier_id,
                'tanggal' => $request->tanggal,
                'jam' => $request->jam,
            ]);

            foreach ($request->items as $item) {
                $product = Product::find($item['product_id']);
                if (!$product) {
                    throw new \Exception("Produk dengan ID {$item['product_id']} tidak ditemukan.");
                }

                $product->stok += $item['jumlah'];
                $product->harga_beli = $item['harga_beli'];
                $product->save();

                $purchase->purchaseDetails()->create([
                    'product_id' => $item['product_id'],
                    'harga_beli' => $item['harga_beli'],
                    'jumlah' => $item['jumlah'],
                    'total' => $item['harga_beli'] * $item['jumlah'],
                ]);
            }

            return new PurchaseResource($purchase->load(['purchaseDetails.product', 'supplier']));
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        return DB::transaction(function () use ($purchase) {
            foreach ($purchase->purchaseDetails as $item) {
                $product = Product::find($item->product_id);
                if ($product && $product->stok < $item->jumlah) {
                    throw new \Exception("Stok produk '{$product->nama_produk}' tidak cukup untuk rollback. Sisa: {$product->stok}, butuh kurangi: {$item->jumlah}");
                }
            }

            foreach ($purchase->purchaseDetails as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->stok -= $item->jumlah;
                    $product->save();
                }
            }

            $purchase->delete();

            return response()->json(['message' => 'Purchase deleted successfully']);
        });
    }
}
