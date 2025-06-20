<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%$search%")
                ->orWhere('toko', 'like', "%$search%")
                ->orWhere('no_telp', 'like', "%$search%")
                ->orWhere('alamat', 'like', "%$search%");
        }

        $sortBy = $request->get('sort_by', 'toko');
        $sortOrder = $request->get('sort_order', 'asc');

        $allowedSorts = ['toko', 'nama', 'no_telp', 'alamat'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        return SupplierResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        //
        return new SupplierResource(Supplier::create($request->validated()));

    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
        return new SupplierResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //
        return new SupplierResource(tap($supplier)->update($request->validated()));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted successfully']);
    }
}
