<?php

use App\Http\Controllers\Api\CustomerController;
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
