<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryContentResource;
use App\Http\Resources\DeliverySlipResource;
use App\Models\CustomerPrice;
use App\Models\DeliveryContent;
use App\Models\DeliverySlip;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DeliverySlipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $deliverySlip = DeliverySlip::with("contents");
        $perPage = 50; // 1ページあたりの表示件数


        if ($request->has('dateFrom') && $request->has('dateTo')) {
            $from  = $request->input("dateFrom");
            $to  = date('Y-m-d', strtotime($request->input("dateTo") . ' +1 day')); // 期間指定用に1日分追加
            $deliverySlip->whereBetween('delivery_slips.publish_date', [$from, $to]);
        }

        if ($request->has('word')) {
            $deliverySlip->where('delivery_slips.customer_name', 'like', '%' . $request->input('word') . '%');
        }
        $deliverySlip = $deliverySlip->orderBy("delivery_slips.publish_date", "desc");
        $deliverySlip = $deliverySlip->paginate($perPage);

        return response()->json($deliverySlip);
        // return DeliverySlipResource::collection($ds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $latestId = DeliverySlip::latest('id')->first()->id;
        return $latestId;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug($request->all());
        DB::transaction(
            function () use ($request) {
                $customer_id = $request->input("customer_id");

                $ds = DeliverySlip::create([
                    "customer_id" => $customer_id,
                    "customer_name" => $request->input("customer_name"),
                    "customer_address" => $request->input("customer_address"),
                    "publish_date" => $request->input("publish_date"),
                    "total_price" => $request->input("total_price"),
                ]);

                foreach ($request["contents"] as $itemData) {
                    $product_id = $itemData["product_id"];
                    // CustomerPriceに登録されてなくて、金額がデフォルトじゃなかったら登録する。
                    $isNewCustomerPrice = CustomerPrice::where("customer_id", $customer_id)->where("product_id", $product_id)->first();
                    Log::debug($product_id);
                    $defaultPrice = Product::find($product_id)->price;
                    if (!$isNewCustomerPrice  && ($itemData["price"] !== $defaultPrice)) {
                        CustomerPrice::create([
                            "customer_id" => $customer_id,
                            "product_id" => $product_id,
                            "price" => $itemData["price"],
                        ]);
                    }

                    $content = new DeliveryContent();
                    $content->delivery_slip_id = $ds->id;
                    $content->product_id = $product_id;
                    $content->product_name = $itemData["product_name"];
                    $content->unit = $itemData["unit"];
                    $content->total_cost = $itemData["total_cost"];
                    $content->price = $itemData["price"];
                    $content->quantity = $itemData["quantity"];
                    $content->gross_profit = $itemData["gross_profit"];
                    $content->subtotal = $itemData["subtotal"];
                    $content->subtotal_gross_profit = $itemData["subtotal_gross_profit"];
                    $content->save();
                }
            }
        );
        // return new DeliverySlipResource($ds);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ds = DeliverySlip::find($id)->delivery_contents()->get();
        return $ds;
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
