<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\DeliveryContent;
use App\Models\MaterialProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::join('product_categories', 'products.product_category_id', '=', 'product_categories.id')->select("products.*", "product_categories.name as category_name")->orderBy('created_at', 'desc')
            ->get();

        return $products;
    }

    // カテゴリ毎のプロダクトを返す
    public function productsByCategory()
    {
        $categories = ProductCategory::with("products")->get();
        return $categories;
    }

    //指定したカテゴリIDのプロダクトを返す
    public function productsByCategoryId($category_id)
    {
        $categories =
            Product::where('products.product_category_id', $category_id)->get();
        return $categories;
    }

    public function categoryIndex()
    {
        $categories = ProductCategory::all();
        return $categories;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product = Product::create([
            "name" => $request->input("name"),
            "product_category_id" => $request->input("product_category_id"),
            "cost" => $request->input("cost"),
            "unit" => $request->input("unit"),
            "price" =>
            $request->input("price"),
            "gross_profit" =>
            $request->input("gross_profit"),
            "gross_rate" =>
            $request->input("gross_rate"),
        ]);

        return new ProductResource($product);
    }

    public function storeCategory(Request $request)
    {
        Log::debug($request->all());

        $category = ProductCategory::create([
            "name" => $request->input("name"),
        ]);
        return $category;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return $product;
    }


    public function showMaterials($product_id)
    {
        $materials = MaterialProduct::with("material")
            ->where("material_products.product_id", $product_id)
            ->get();
        return response()->json($materials);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoryShow($id)
    {
        $product = ProductCategory::find($id);
        return $product;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Product::findOrFail($id);
        $data->update([
            "name" => $request->input("name"),
            "product_category_id" => $request->input("product_category_id"),
            "cost" => $request->input("cost"),
            "unit" => $request->input("unit"),
            "price" =>
            $request->input("price"),
            "gross_profit" =>
            $request->input("gross_profit"),
            "gross_rate" =>
            $request->input("gross_rate"),
        ]);
        return $data;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request, $id)
    {
        $data = ProductCategory::findOrFail($id);
        $data->update([
            'name' => $request->input('name'),
        ]);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCategory($id)
    {
        $category = ProductCategory::find($id);
        $category->delete();
    }
}
