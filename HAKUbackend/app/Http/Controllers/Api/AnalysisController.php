<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryContent;
use App\Models\DeliverySlip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnalysisController extends Controller
{

    /**
     * ある期間の商品の販売数と粗利一覧を取得する
     *
     * @param  string  $from
     * @param  string  $to
     * @return \Illuminate\Http\Response
     */
    public function sales($from, $to)
    {
        $toDate  = date('Y-m-d', strtotime($to . ' +1 day')); // 期間指定用に1日分追加

        $sumQuantity = DeliverySlip::query()
            ->leftJoin("delivery_contents", "delivery_contents.delivery_slip_id", "=", "delivery_slips.id")
            ->leftJoin("products", "delivery_contents.product_id", "=", "products.id")
            ->whereBetween('delivery_slips.publish_date', [$from, $toDate])
            ->select(
                "delivery_contents.product_id",
                "products.name",
                "products.unit",
                DB::raw("SUM(delivery_contents.quantity) AS sum_quantity"),
                DB::raw("SUM(delivery_contents.gross_profit) AS sum_gross_profit")
            )
            ->groupBy("delivery_contents.product_id", "products.name", "products.unit")
            ->havingRaw("sum_quantity IS NOT NULL")
            ->get();

        return $sumQuantity;
    }

    // 指定期間の日付毎の粗利を取得する
    public function daily_profit($from, $to)
    {
        $toDate  = date($to, strtotime("1 day")); //期間指定用に1日分追加

        $profit = DeliverySlip::query()->leftJoin("delivery_contents", "delivery_contents.delivery_slip_id", "=", "delivery_slips.id")->select("delivery_slips.publish_date")->whereBetween('delivery_slips.publish_date', [$from, $toDate])->selectRaw("SUM(delivery_contents.gross_profit) AS sum_gross_profit")->groupBy("delivery_slips.publish_date")->havingRaw("sum_gross_profit IS NOT NULL")->get();

        return $profit;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
