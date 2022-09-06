<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SellerPickupPoint;

class SellerPickupPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller_pickup_points = SellerPickupPoint::paginate(15);
        return view('seller_pickup_point.index', compact('seller_pickup_points'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller_pickup_point.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seller_pickup_point = new SellerPickupPoint;
        $seller_pickup_point->name = $request->name;
        $seller_pickup_point->address = $request->address;
        $seller_pickup_point->phone = $request->phone;
        $seller_pickup_point->pick_up_status = $request->pick_up_status;
        //$seller_pickup_point->cash_on_pickup_status = $request->cash_on_pickup_status;
        $seller_pickup_point->staff_id = $request->staff_id;
        if ($seller_pickup_point->save()) {
            flash(translate('PicupPoint has been inserted successfully'))->success();
            return redirect()->route('pick_up_points.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
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
        $seller_pickup_point = SellerPickupPoint::findOrFail(decrypt($id));
        return view('seller_pickup_point.edit', compact('seller_pickup_point'));
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
        $seller_pickup_point = SellerPickupPoint::findOrFail($id);
        $seller_pickup_point->name = $request->name;
        $seller_pickup_point->address = $request->address;
        $seller_pickup_point->phone = $request->phone;
        $seller_pickup_point->pick_up_status = $request->pick_up_status;
        //$seller_pickup_point->cash_on_pickup_status = $request->cash_on_pickup_status;
        $seller_pickup_point->staff_id = $request->staff_id;
        if ($seller_pickup_point->save()) {
            flash(translate('PicupPoint has been updated successfully'))->success();
            return redirect()->route('pick_up_points.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller_pickup_point = SellerPickupPoint::findOrFail($id);
        if(SellerPickupPoint::destroy($id)){
            flash(translate('PicupPoint has been deleted successfully'))->success();
            return redirect()->route('pick_up_points.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
}
