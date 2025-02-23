<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $supplier=Supplier::all();
        // return view('Supplier.supplier', ['supplier'=>$supplier]);
        // return SupplierResource::collection(Supplier::paginate(5));
        return SupplierResource::collection(Supplier::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        //
        // return new SupplierResource(Supplier::create($request->validated()));
        $supplier = Supplier::create($request->validated());
        return new SupplierResource($supplier);
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
        // return new SupplierResource(tap($supplier)->update($request->validated()));
        $supplier->update($request->validated());
        return new SupplierResource($supplier);
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
