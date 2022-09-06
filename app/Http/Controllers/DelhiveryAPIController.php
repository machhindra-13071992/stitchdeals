<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cookie;
use Auth;
use Config;
use App\Order;
use Redirect,Response;
use DB;

class DelhiveryAPIController extends Controller
{
	private $client = '';
	private $url = 'https://staging-express.delhivery.com';
	private $api_token = '';
	private $pickup = '';
	private $user = '';
	
	public function __construct(){
		$this->client = Config::get('partners.partners.'.env('DELHIVERY_API_URL').'.client');
		$this->url = Config::get('partners.partners.'.env('DELHIVERY_API_URL').'.url');
		$this->api_token = Config::get('partners.partners.'.env('DELHIVERY_API_URL').'.api_token');
		$this->pickup = Config::get('partners.partners.'.env('DELHIVERY_API_URL').'.pickup');
		$this->user = Config::get('partners.partners.'.env('DELHIVERY_API_URL').'.user');
	}
	
   public function pincodeServiceability($postData=array()){
	   try  {
			$url = $this->url.'/c/api/pin-codes/json/?token='.$this->api_token.'&filter_codes='.$postData['postal_code'];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec ($ch);
			$err = curl_error($ch); //if you need
			curl_close ($ch);
			$response = json_decode($response, true);
			if(isset($response['delivery_codes']) && !empty($response['delivery_codes'])){
				Session::put('pincode_servicable',1);
				Session::put('postal_code',$postData['postal_code']);
			}else{
			    Session::put('pincode_servicable',0);
				Session::put('postal_code',$postData['postal_code']);
			}
	   } catch (Exception $e) {
		   Session::put('pincode_servicable',0);
           return ['data'=>false,'exception'=>$e];
       }
   }
   
   
   public function trackOrder($postData=array()){
       $responseArr = array();
	   try  {
			$url = $this->url.'/api/v1/packages/json/?token='.$this->api_token.'&waybill='.$postData['waybill_code'];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec ($ch);
			$err = curl_error($ch);
			curl_close ($ch);
			$responseArr['response'] = $response;
			$responseArr['error']= 0;
			$responseArr['error_msg'] = "Order has been recieved by delhivery express.";
	   } catch (Exception $e) {
           $responseArr['error']=1;
		   $responseArr['error_msg']="Invalid request";
		   $responseArr['response'] = "";
       }
       return $responseArr;
   }
  
   public function createOrder($postData=array()){
	   $responseArr = array();
	   try  {
			$payload = 'format=json&data='.$this->returnOrderJsonData($postData);
			$url = $this->url.'/api/cmu/create.json';
			$ch = curl_init();
			$headr = array();
			$headr[] = 'Content-type: application/json';
			$headr[] = 'Authorization: Token '.$this->api_token;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5000);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
			$response = curl_exec($ch);
			$content = curl_getinfo($ch);
			curl_close($ch);
			$response = json_decode($response,true);
			if(isset($response['packages'][0])){
			    if($response['packages'][0]['status'] == "Success"){
    				$responseArr['error']= 0;
    				$responseArr['response'] = json_encode($response);
    				$responseArr['error_msg'] = "Order has been recieved by delhivery express.";
    				$responseArr['waybill']= $response['packages'][0]['waybill'];
    				\App\Order::where('id','=',$postData->id)->update(['waybill_code'=>$response['packages'][0]['waybill']]);
    			}else{
    				$responseArr['error']= 1;
    				$responseArr['error_msg']="Duplicate order id.";
    				$responseArr['response'] = json_encode($response);
    				$responseArr['waybill']= $response['packages'][0]['waybill'];
    				\App\Order::where('id','=',$postData->id)->update(['waybill_code'=>$response['packages'][0]['waybill']]);
    			}
			}
			
	   } catch (Exception $e) {
		   $responseArr['error']=1;
		   $responseArr['error_msg']="Invalid request";
       }
	   
	   return $responseArr;
   }
   
   public function returnOrderJsonData($orderData){
	   $responseData = array();
	   $indexRow = 0;
	   $responseData['shipments'][$indexRow]['add'] = json_decode($orderData->shipping_address)->address;
	   $responseData['shipments'][$indexRow]['phone'] = json_decode($orderData->shipping_address)->phone;
	   if($orderData['payment_type'] == "cash_on_delivery"){
		$responseData['shipments'][$indexRow]['payment_mode'] = "COD";
		$responseData['shipments'][$indexRow]['cod_amount'] = $orderData->grand_total;
	   }else{
		   $responseData['shipments'][$indexRow]['payment_mode'] = "Prepaid";
	   }
	   $responseData['shipments'][$indexRow]['order_date'] = $orderData->created_at;
	   $responseData['shipments'][$indexRow]['total_amount'] = $orderData->grand_total;
	   $responseData['shipments'][$indexRow]['name'] = json_decode($orderData->shipping_address)->name;
	   $responseData['shipments'][$indexRow]['pin'] = json_decode($orderData->shipping_address)->postal_code;
	   $responseData['shipments'][$indexRow]['order'] = $orderData->code;
	   $responseData['shipments'][$indexRow]['client'] = $this->client;
	   $responseData['pickup_location']['name'] = $this->pickup;
	   return json_encode($responseData,JSON_UNESCAPED_UNICODE);
   }

   public function cancelOrder($postData=array()){
	   $responseArr = array();
	   try  {
			$url = $this->url.'/api/p/edit';
			$ch = curl_init();
			$payload = array("waybill"=>$postData['waybill'],"cancellation" =>"true");
			$headr = array('Content-type: application/json','Authorization: Token '.$this->api_token);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5000);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($payload,JSON_UNESCAPED_UNICODE));
			$response = curl_exec($ch);
			//dd($response);
			$content = curl_getinfo($ch);
			curl_close($ch);
			$response = json_decode($response,true);
			if(isset($response['status']) && $response['status'] == true){
				$responseArr['error']= 0;
				$responseArr['response'] = $response;
				$responseArr['error_msg'] = "Shipment has been cancelled.";
			}else{
				$responseArr['error']= 1;
				$responseArr['error_msg']="Shipment has not cancelled.";
			}
	   } catch (Exception $e) {
		   $responseArr['error']=1;
		   $responseArr['error_msg']="Invalid request";
       }
	   return $responseArr;
   }

   public function createWarehouse($payload=array()){
	   $responseArr = array();
	   try  {
			$url = $this->url.'/api/backend/clientwarehouse/create/';
			$ch = curl_init();
			$headr = array('Content-type: application/json','Accept: application/json','Authorization: Token '.$this->api_token);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5000);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($payload,JSON_UNESCAPED_UNICODE));
			$response = curl_exec($ch);
			$content = curl_getinfo($ch);
			curl_close($ch);
			$response = json_decode($response,true);
			if(isset($response['success']) && empty($response['error'])){
				$responseArr['error']= 0;
				$responseArr['response'] = $response;
				$responseArr['error_msg'] = "Warehouse created.";
			}else{
				$responseArr['response'] = $response;
				$responseArr['error']= 1;
				$responseArr['error_msg']="Warehouse has not created.";
			}
	   } catch (Exception $e) {
		   $responseArr['error']=1;
		   $responseArr['error_msg']="Invalid request";
       }
	   return $responseArr;
   }


   
   public function express_delhivery_order_tracking_cron(){
       ini_set('max_execution_time',0);
       $responseData = array();
       $responseData['error']=1;
	   $responseData['error_msg'] = "order status not updated";
	   $responseData['response'] = array();
       $orders = DB::table('orders')->join('order_details','orders.id', '=', 'order_details.order_id')->select('orders.id','orders.waybill_code','order_details.order_id','order_details.payment_status','order_details.delivery_status')->where('order_details.delivery_status','!=','delivered')->where('order_details.delivery_status','!=','cancelled')->whereNotNull('orders.waybill_code')->get();
       foreach($orders as $order_details){
            $url = $this->url.'/api/v1/packages/json/?token='.$this->api_token.'&waybill='.$order_details->waybill_code;
            $ch = curl_init();
        	curl_setopt($ch, CURLOPT_URL, $url);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	$response = curl_exec ($ch);
        	$err = curl_error($ch);
        	curl_close($ch);
        	$responseData['response'] = $response;
        	$response = json_decode($response,true);
        	if(isset($response['ShipmentData'])){
        	    foreach($response['ShipmentData'] as $shipment_records){
        	        $delivery_status = "pending";
        	        $orderStatusType = isset($shipment_records['Shipment']['Status']['Status'])?$shipment_records['Shipment']['Status']['Status'] : "";
        	        if($orderStatusType == "Manifested"){
        	            $delivery_status = "pending";
        	        }else if($orderStatusType == "In Transit"){
        	            $delivery_status = "on_review";
        	        }else if($orderStatusType == "Dispatched"){
        	            $delivery_status = "on_delivery";
        	        }else if($orderStatusType == "Delivered"){
        	            $delivery_status = "delivered";
        	            DB::table('order_details')->where('order_id',$order_details->order_id)->update(['payment_status'=>'paid']);
        	            DB::table('orders')->where('id',$order_details->order_id)->update(['payment_status'=>'paid']);
        	        }
        	        DB::table('order_details')->where('order_id',$order_details->order_id)->update(['delivery_status'=>$delivery_status,'express_delhivery_tracking_responce'=>$responseData['response']]);
        	    }
        	}
        	$responseData['error'] = 1;
	        $responseData['error_msg'] = "order status updated successfully.";
       }
       return Response::json($responseData,200,['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
   }
   
}
