<?php

use App\Http\Controllers\Api\AnalysisController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DeliverySlipController;
use App\Http\Controllers\Api\FixedCostController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\MaterialController;
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
        Route::post("", [ProductController::class, "store"])->name("store");

        Route::get("/groupByCategories", [ProductController::class, "productsByCategory"])->name("productsByCategory");
        Route::get("/groupByCategory/{category_id}", [ProductController::class, "productsByCategoryId"])->name("productsByCategoryId");

        Route::get("/{productId}", [ProductController::class, "show"])->name("show");
        Route::patch("/{productId}", [ProductController::class, "update"])->name("update");
        Route::delete("/{productId}", [ProductController::class, "destroy"])->name("destroy");

        Route::get('/{productId}/materials', [ProductController::class, 'showMaterials']);
        Route::get('/{productId}/materials/{materialId}', [ProductController::class, 'showMaterials']);
    });

Route::prefix("category")
    ->name("category.")
    ->group(function () {
        Route::get("", [ProductController::class, "categoryIndex"])->name("categoryIndex");
        Route::post("", [ProductController::class, "storeCategory"])->name("storeCategory");

        Route::get("/{id}", [ProductController::class, "categoryShow"])->name("categoryShow");
        Route::patch("/{id}", [ProductController::class, "updateCategory"])->name("updateCategory");
        Route::delete("/{id}", [ProductController::class, "destroyCategory"])->name("destroyCategory");
    });

Route::prefix("customer")
    ->name("customer.")
    ->group(function () {
        Route::get("", [CustomerController::class, "index"])->name("index");
        Route::post("", [CustomerController::class, "store"])->name("store");

        Route::get("/customer_price/{id}", [CustomerController::class, "showCustomerPrice"])->name("showCustomerPrice");
        Route::get("/customer_price", [CustomerController::class, "searchProducts"])->name("searchProducts");
        Route::get("/{customer_id}/customer_price", [CustomerController::class, "showCustomerProducts"])->name("showCustomerProducts");
        Route::patch("/customer_price/{id}", [CustomerController::class, "updateCustomerPrice"])->name("updateCustomerPrice");
        Route::delete("/customer_price/{id}", [CustomerController::class, "destroyCustomerPrice"])->name("destroyCustomerPrice");
    });

Route::prefix("delivery_slip")
    ->name("delivery_slip.")
    ->group(function () {
        Route::get("", [DeliverySlipController::class, "index"])->name("index");
        Route::get("/create", [DeliverySlipController::class, "create"])->name("create");
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


Route::prefix("fixed_cost")
    ->name("fixed_cost.")
    ->group(function () {
        Route::get("", [FixedCostController::class, "index"])->name("index");
        Route::post("", [FixedCostController::class, "store"])->name("store");
        Route::get("/day", [FixedCostController::class, "day"])->name("day");

        Route::get("/{id}", [FixedCostController::class, "show"])->name("show");
        Route::patch("/{id}", [FixedCostController::class, "update"])->name("update");
        Route::delete("/{id}", [FixedCostController::class, "destroy"])->name("destroy");
    });

Route::prefix("analysis")
    ->name("analysis.")
    ->group(function () {
        Route::get("/sales/{from}/{to}", [AnalysisController::class, "sales"])->name("sales");
        Route::get("/daily_profit/{from}/{to}", [AnalysisController::class, "daily_profit"])->name("daily_profit");
    });

Route::prefix("material")
    ->name("material.")
    ->group(function () {
        Route::get("", [MaterialController::class, "index"])->name("index");
        Route::post("", [MaterialController::class, "store"])->name("store");

        Route::get("/{id}/products", [MaterialController::class, "showProducts"])->name("showProducts");
    });
