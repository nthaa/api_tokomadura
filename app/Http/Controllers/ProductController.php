<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_produk', 'like', "%$search%")
                ->orWhere('barcode', 'like', "%$search%");
        }

        $sortBy = $request->get('sort_by', 'nama_produk');
        $sortOrder = $request->get('sort_order', 'asc');

        $allowedSorts = ['nama_produk', 'harga_beli', 'harga_jual', 'stok', 'barcode'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        if ($request->query('all') === 'true') {
            $products = $query->orderBy('nama_produk')->get();
            return response()->json($products);
        }

        $products = $query->paginate(10);
        return ProductResource::collection($products);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
         return new ProductResource(Product::create($request->validated()));

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        return new ProductResource(tap($product)->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
