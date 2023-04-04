<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FixedCostResource;
use App\Models\FixedCost;
use Illuminate\Http\Request;

class FixedCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fc = FixedCost::orderBy("created_at", "desc")
            ->get();

        return $fc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function day()
    {
        $fc = FixedCost::sum("price");
        $day = ($fc * 12) / 365;
        return $day;
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
        $fixed_cost = FixedCost::create([
            "name" => $request->input("name"),
            "price" => $request->input("price"),
        ]);

        return new FixedCostResource($fixed_cost);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fixedCost = FixedCost::find($id);
        return $fixedCost;
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
        $data = FixedCost::findOrFail($id);
        $data->update([
            "name" => $request->input("name"),
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
        $fixed_cost = FixedCost::find($id);
        $fixed_cost->delete();
    }
}
