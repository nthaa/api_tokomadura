<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('supplier',[SupplierController::class, 'index'])->name('tampilsupplier');




