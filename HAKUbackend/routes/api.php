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

Route::prefix("product")
    ->name("product.")
    ->group(function () {
        Route::get("", [ProductController::class, "index"])->name("index");
        Route::get("/categories", [ProductController::class, "categories"])->name("categories");
        Route::get("/{id}", [ProductController::class, "show"])->name("show");
        Route::post("", [ProductController::class, "store"])->name("store");
    });


Route::prefix("customer")
    ->name("customer.")
    ->group(function () {
        Route::get("", [CustomerController::class, "index"])->name("index");
        Route::post("", [CustomerController::class, "store"])->name("store");
    });

Route::prefix("delivery_slip")
    ->name("delivery_slip.")
    ->group(function () {
        Route::get("", [DeliverySlipController::class, "index"])->name("index");
        Route::get("/{id}", [DeliverySlipController::class, "show"])->name("show");
        Route::post("", [DeliverySlipController::class, "store"])->name("store");
        Route::post("/contents", [DeliverySlipController::class, "contents"])->name("contents");
    });

Route::prefix("invoice")
    ->name("invoice.")
    ->group(function () {
        Route::get("", [InvoiceController::class, "index"])->name("index");

        Route::get("/{id}", [InvoiceController::class, "show"])->name("show");

        Route::post("", [InvoiceController::class, "store"])->name("store");
    });
