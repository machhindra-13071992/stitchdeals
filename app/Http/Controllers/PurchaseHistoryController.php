<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DelhiveryAPIController;
use App\Order;
use App\Product;
use App\OrderDetail;
use Auth;
use DB;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order_status = null;
        $queryData[] = ['user_id', Auth::user()->id];
        $queryDataDetails = array();
        if ($request->order_status != null){
            if($request->order_status == 'open_orders'){
                $queryDataDetails[] = ['order_details.delivery_status','pending'];
            }
            if($request->order_status == 'cancelled_orders'){
                $queryDataDetails[] = ['order_details.delivery_status','order_cancelled'];
            }
            $order_status = $request->order_status;
        }
        $callback =  function ($order_details) use ($queryDataDetails) { $order_details->where($queryDataDetails);  };
        $orders = Order::whereHas('orderDetails',$callback)->with('orderDetails.product')->where($queryData)->orderBy('code', 'desc')->paginate(9);
        $product_ids = DB::table('orders')
                    ->join('order_details','orders.id', '=', 'order_details.order_id')
                    ->distinct('order_details.product_id')
                    ->where('orders.user_id',Auth::user()->id)
                    ->where('order_details.delivery_status','delivered')
                    ->pluck('order_details.product_id','order_details.product_id')->toArray();
        $conditions = ['published' => 1];
        $products = Product::where($conditions);
        $products = $products->whereIn('id',$product_ids);
        $products = filter_products($products)->get();
        return view('frontend.purchase_history', compact('orders','order_status','products'));
    }

    public function digital_index()
    {
        $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->join('products', 'order_details.product_id', '=', 'products.id')
                        ->where('orders.user_id', Auth::user()->id)
                        ->where('products.digital', '1')
                        ->where('order_details.payment_status', 'paid')
                        ->select('order_details.id')
                        ->paginate(1);
        return view('frontend.digital_purchase_history', compact('orders'));
    }

    public function purchase_history_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = 1;
        $order->payment_status_viewed = 1;
        $order->save();
        return view('frontend.partials.order_details_customer', compact('order'));
    }

    public function purchase_order_tracking_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order_delhivery_trackings = array();
        $order->delivery_viewed = 1;
        $order->payment_status_viewed = 1;
        $order->save();
        if(env('DELHIVERY_API_MODE') == "ON"){
            $postData['waybill_code'] = $order->waybill_code;
            $delhiveryExpressAPIController = new DelhiveryAPIController;
            $order_delhivery_trackings = $delhiveryExpressAPIController->trackOrder($postData);
        }
        return view('frontend.partials.order_tracking_details', compact('order','order_delhivery_trackings'));
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