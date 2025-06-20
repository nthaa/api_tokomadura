<?php

namespace App\Http\Controllers;

use App\Models\TempSale;
use App\Http\Requests\StoreTempSaleRequest;
use App\Http\Requests\UpdateTempSaleRequest;
use App\Http\Resources\TempSaleResource;
use Illuminate\Support\Facades\Auth;

class TempSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return TempSaleResource::collection(TempSale::paginate(10));
         $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }

            // Ambil data berdasarkan user_id
           return TempSaleResource::collection(
                TempSale::where('user_id', $user->id)->latest()->paginate(10)
            );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTempSaleRequest $request)
    {
        //
       $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $data = $request->validated();
        $data['user_id'] = $user->id;
        $data['total'] = $data['harga'] * $data['jumlah'];

        $tempSale = TempSale::create($data);

        return new TempSaleResource($tempSale);

        }

    /**
     * Display the specified resource.
     */
    public function show(TempSale $tempSale)
    {
        //
        return new TempSaleResource($tempSale);
    }


    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateTempSaleRequest $request, TempSale $tempSale)
    {
        $data = $request->validated();
        $data['total'] = $data['harga'] * $data['jumlah'];

        $tempSale->update($data);

        return new TempSaleResource($tempSale);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TempSale $tempSale)
    {
        //
        $tempSale->delete();
        return response()->json(['message' => 'Item keranjang dihapus']);
    }
}
