<?php

namespace App\Http\Controllers;

use App\Models\PengaturanToko;
use App\Http\Requests\StorePengaturanTokoRequest;
use App\Http\Requests\UpdatePengaturanTokoRequest;
use App\Http\Resources\PengaturanTokoResource;

class PengaturanTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return PengaturanTokoResource::collection(PengaturanToko::paginate(1));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengaturanTokoRequest $request)
    {
        //
        return new PengaturanTokoResource(PengaturanToko::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(PengaturanToko $pengaturanToko)
    {
        //
        return new PengaturanTokoResource($pengaturanToko);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengaturanTokoRequest $request, PengaturanToko $pengaturanToko)
    {
        //
        return new PengaturanTokoResource(tap($pengaturanToko)->update($request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengaturanToko $pengaturanToko)
    {
        //
        $pengaturanToko->delete();
        return response()->json(['message' => 'PengaturanToko deleted successfully']);
    }
}
