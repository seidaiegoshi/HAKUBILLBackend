<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\CustomerPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::orderBy("created_at", "desc");

        if ($request->has('customer_name')) {
            $customers->where('customers.name', 'like', '%' . $request->input('customer_name') . '%');
        }

        $customers = $customers->get();
        return CustomerResource::collection($customers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCustomerPrice($id)
    {
        // Log::debug($request->all());
        $customerPrice = CustomerPrice::with("products")->with("customers")->find($id);


        return response()->json($customerPrice);
    }



    // 取引先や商品で検索する
    public function searchProducts(Request $request)
    {
        $customerPrice = CustomerPrice::query()
            ->leftJoin("products", "customer_prices.product_id", "=", "products.id")
            ->leftJoin("customers", "customer_prices.customer_id", "=", "customers.id")
            ->select(
                'customer_prices.id',
                'customer_prices.customer_id',
                'customer_prices.product_id',
                'customer_prices.price',
                'customer_prices.updated_at',
                'products.name as product_name',
                'customers.name as customer_name'
            );

        if ($request->has('customer_name')) {
            $customerPrice->where('customers.name', 'like', '%' . $request->input('customer_name') . '%');
        }

        if ($request->has('product_name')) {
            $customerPrice->where('products.name', 'like', '%' . $request->input('product_name') . '%');
        }

        $customerPrice = $customerPrice->get();

        return response()->json($customerPrice);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Customer::create([
            "name" => $request->input("name"),
            "honorific" => $request->input("honorific"),
            "post" => $request->input("post"),
            "post_code" =>
            $request->input("post_code"),
            "address" =>
            $request->input("address"),
            "telephone_number" =>
            $request->input("telephone_number"),
            "fax_number" =>
            $request->input("fax_number"),
        ]);
        return new CustomerResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCustomerProducts($customerId)
    {
        // $customerProducts = CustomerPrice::with("products")->get();
        $customerProducts = CustomerPrice::query()->leftJoin("products", "customer_prices.product_id", "=", "products.id")->select("customer_prices.*", "products.name", "products.total_cost", "products.unit")->where("customer_prices.customer_id", $customerId)->get();

        return response()->json($customerProducts);
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
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCustomerPrice(Request $request, $id)
    {
        $data = CustomerPrice::findOrFail($id);
        $data->update([
            "price" =>
            $request->input("price"),
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
        //
    }
    public function destroyCustomerPrice($id)
    {
        $category = CustomerPrice::find($id);
        $category->delete();
    }
}
