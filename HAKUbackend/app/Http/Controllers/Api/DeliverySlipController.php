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
        $ds = DeliverySlip::create([
            "customer_id" => $request->input("customer_id"),
            "publish_date" => $request->input("publish_date"),
        ]);
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


    // 指定期間の日付毎の粗利を取得する
    public function daily_profit($from, $to)
    {
        $toDate  = date($to, strtotime("1 day")); //期間指定用に1日分追加

        $profit = DeliverySlip::query()->leftJoin("delivery_contents", "delivery_contents.delivery_slip_id", "=", "delivery_slips.id")->select("delivery_slips.publish_date")->whereBetween('delivery_slips.publish_date', [$from, $toDate])->selectRaw("SUM(delivery_contents.gross_profit) AS sum_gross_profit")->groupBy("delivery_slips.publish_date")->havingRaw("sum_gross_profit IS NOT NULL")->get();

        return $profit;
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
