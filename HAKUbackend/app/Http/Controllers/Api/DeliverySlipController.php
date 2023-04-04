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
        $delivery_Slip = DB::transaction(
            function () use ($request) {
                $customer_id = $request->input("customer_id");

                $ds = DeliverySlip::create([
                    "customer_id" => $customer_id,
                    "customer_name" => $request->input("customer_name"),
                    "customer_address" => $request->input("customer_address"),
                    "customer_post_code" => $request->input("customer_post_code"),
                    "publish_date" => $request->input("publish_date"),
                    "total_price" => $request->input("total_price"),
                ]);

                foreach ($request["contents"] as $itemData) {
                    $product_id = $itemData["product_id"];
                    if ($product_id !== null) {
                        // CustomerPriceに登録されてなくて、金額がデフォルトじゃなかったら登録する。
                        $isNewCustomerPrice = CustomerPrice::where("customer_id", $customer_id)->where("product_id", $product_id)->first();
                        $defaultPrice = Product::find($product_id)->price;
                        if (!$isNewCustomerPrice  && ($itemData["price"] !== $defaultPrice)) {
                            CustomerPrice::create([
                                "customer_id" => $customer_id,
                                "product_id" => $product_id,
                                "price" => $itemData["price"],
                            ]);
                        }
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
                return $ds; // トランザクションの戻り値として$dsを返す

            }
        );
        return $delivery_Slip;
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
        $delivery_Slip = DB::transaction(
            function () use ($request, $id) {
                $ds = DeliverySlip::find($id);
                $customer_id = $request->input("customer_id");

                // 納品書の基本データを登録
                $ds->update([
                    "customer_id" => $customer_id,
                    "customer_name" => $request->input("customer_name"),
                    "customer_address" => $request->input("customer_address"),
                    "customer_post_code" => $request->input("customer_post_code"),
                    "publish_date" => $request->input("publish_date"),
                    "total_price" => $request->input("total_price"),
                ]);



                // 納品書のコンテンツを登録する。
                //  一度消して、登録し直す。
                DeliveryContent::where("delivery_slip_id", $id)->delete();

                foreach ($request["contents"] as $itemData) {
                    $product_id = $itemData["product_id"];

                    // 取引先が初めてその商品を扱う場合、それを取引先別価格として登録する。
                    if ($product_id !== null) {
                        // CustomerPriceに登録されてなくて、金額がデフォルトじゃなかったら登録する。
                        $isNewCustomerPrice = CustomerPrice::where("customer_id", $customer_id)->where("product_id", $product_id)->first();
                        $defaultPrice = Product::find($product_id)->price;
                        if (!$isNewCustomerPrice  && ($itemData["price"] !== $defaultPrice)) {
                            CustomerPrice::create([
                                "customer_id" => $customer_id,
                                "product_id" => $product_id,
                                "price" => $itemData["price"],
                            ]);
                        }
                    }

                    // コンテンツを登録する。
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
                return $ds; // トランザクションの戻り値として$dsを返す

            }
        );
        return $delivery_Slip;
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
