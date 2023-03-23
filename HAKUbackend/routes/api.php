<?php

use App\Http\Controllers\Api\AnalysisController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DeliverySlipController;
use App\Http\Controllers\Api\FixedCostController;
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
        // 商品一覧
        Route::get("", [ProductController::class, "index"])->name("index");
        // 商品を登録
        Route::post("", [ProductController::class, "store"])->name("store");
        // カテゴリ一覧
        Route::get("/category", [ProductController::class, "category"])->name("category");
        // カテゴリを登録
        Route::post("/category", [ProductController::class, "storeCategory"])->name("storeCategory");
        // カテゴリ毎の商品一覧
        Route::get("/groupByCategories", [ProductController::class, "productsByCategory"])->name("productsByCategory");
        // 指定カテゴリの商品一覧
        Route::get("/groupByCategory/{category_id}", [ProductController::class, "productsByCategoryId"])->name("productsByCategoryId");
        // 特定商品を表示
        Route::get("/{id}", [ProductController::class, "show"])->name("show");
    });

Route::prefix("customer")
    ->name("customer.")
    ->group(function () {
        Route::get("", [CustomerController::class, "index"])->name("index");
        Route::get("/{word}", [CustomerController::class, "search"])->name("search");
        Route::post("", [CustomerController::class, "store"])->name("store");
    });

Route::prefix("delivery_slip")
    ->name("delivery_slip.")
    ->group(function () {
        Route::get("", [DeliverySlipController::class, "index"])->name("index");
        Route::get("/create", [DeliverySlipController::class, "create"])->name("create");
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


Route::prefix("fixed_cost")
    ->name("fixed_cost.")
    ->group(function () {
        Route::get("", [FixedCostController::class, "index"])->name("index");
        Route::post("", [FixedCostController::class, "store"])->name("store");
    });

Route::prefix("analysis")
    ->name("analysis.")
    ->group(function () {
        Route::get("/sales/{from}/{to}", [AnalysisController::class, "sales"])->name("sales");
        Route::get("/daily_profit/{from}/{to}", [AnalysisController::class, "daily_profit"])->name("daily_profit");
    });
