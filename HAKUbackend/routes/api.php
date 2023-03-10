<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DeliverySlipController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("products")
    ->name("products.")
    ->group(function () {
        Route::get("", [ProductController::class, "index"])->name("index");
        Route::post("", [ProductController::class, "store"])->name("store");
    });


Route::prefix("customers")
    ->name("customers.")
    ->group(function () {
        Route::get("", [CustomerController::class, "index"])->name("index");
        Route::post("", [CustomerController::class, "store"])->name("store");
    });

Route::prefix("delivery_slips")
    ->name("delivery_slips.")
    ->group(function () {
        Route::get("", [DeliverySlipController::class, "index"])->name("index");

        Route::get("/{id}", [DeliverySlipController::class, "show"])->name("show");

        Route::post("", [DeliverySlipController::class, "store"])->name("store");
    });

Route::prefix("invoice")
    ->name("invoice.")
    ->group(function () {
        Route::get("", [InvoiceController::class, "index"])->name("index");

        Route::get("/{id}", [InvoiceController::class, "show"])->name("show");

        Route::post("", [InvoiceController::class, "store"])->name("store");
    });
