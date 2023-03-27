<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryContentResource;
use App\Http\Resources\DeliverySlipResource;
use App\Models\DeliveryContent;
use App\Models\DeliverySlip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeliverySlipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds = DeliverySlip::orderBy("created_at", "desc")
            ->get();

        return DeliverySlipResource::collection($ds);
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
        $ds = DeliverySlip::create([
            "customer_id" => $request->input("customer_id"),
            "publish_date" => $request->input("publish_date"),
        ]);

        foreach ($request["contents"] as $itemData) {
            $content = new DeliveryContent();
            $content->delivery_slip_id = $ds->id;
            $content->product_id = $itemData["product_id"];
            $content->product_name = $itemData["product_name"];
            $content->unit = $itemData["unit"];
            $content->cost = $itemData["cost"];
            $content->price = $itemData["price"];
            $content->quantity = $itemData["quantity"];
            $content->gross_profit = $itemData["gross_profit"];
            $content->subtotal = $itemData["subtotal"];
            $content->subtotal_gross_profit = $itemData["subtotal_gross_profit"];
            $content->save();
        }

        return new DeliverySlipResource($ds);
    }

    // 納品書のコンテンツを登録する
    public function contents(Request $request)
    {
        $contentsArray = [];

        foreach ($request->all() as $key => $arr) {
            $content = new DeliveryContent;
            foreach ($arr as $key => $value) {
                $content->$key = $value;
            }
            $content->save();
            array_push($contentsArray, $content);
        }
        return $contentsArray;
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
