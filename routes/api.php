<?php

use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function () {
    $data = ["message" => "hello world"];
    return response()->json($data);
});

// route middleware for authenticated user
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/quote', QuoteController::class);
    Route::post('/logout', [ApiAuthController::class, 'logout']);

});
// Route::apiResource('/supplier', SupplierController::class);
Route::apiResource('/supplier', SupplierController::class);
Route::apiResource('/product', ProductController::class);
<<<<<<< HEAD
Route::apiResource('/saledetail', SaleDetailController::class);
=======
Route::apiResource('/purchase', PurchaseController::class);
>>>>>>> 065d0b175d65d16b4b0400498c91747002d388e2

Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);
