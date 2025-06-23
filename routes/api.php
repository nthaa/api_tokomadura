    <?php

    use App\Http\Controllers\ApiAuthController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\PurchaseController;
    use App\Http\Controllers\PurchaseDetailController;
    use App\Http\Controllers\QuoteController;
    use App\Http\Controllers\SaleDetailController;
    use App\Http\Controllers\SupplierController;
    use App\Http\Controllers\SaleController;
    use App\Http\Controllers\TempPurchaseController;
    use App\Http\Controllers\TempSaleController;
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
        Route::post('/logout', [ApiAuthController::class, 'logout']);
        Route::post('/change-password', [ApiAuthController::class, 'changePassword']);

        Route::apiResource('/dashboard', DashboardController::class);
        Route::apiResource('/products', ProductController::class);
        Route::apiResource('/suppliers', SupplierController::class);
        Route::apiResource('/purchases', PurchaseController::class);
        Route::apiResource('/purchase-details', PurchaseDetailController::class);
        Route::apiResource('/temp-purchases', TempPurchaseController::class);
        Route::apiResource('/temp-sales', TempSaleController::class);
        Route::apiResource('/sales', SaleController::class);
        Route::apiResource('/sale-details', SaleDetailController::class);



    });

    Route::post('/register', [ApiAuthController::class, 'register']);
    Route::post('/login', [ApiAuthController::class, 'login']);
