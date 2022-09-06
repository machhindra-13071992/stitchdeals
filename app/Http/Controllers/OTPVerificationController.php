<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\AffiliateController;
use App\Order;
use App\Product;
use App\Color;
use App\OrderDetail;
use App\CouponUsage;
use App\OtpConfiguration;
use App\User;
use App\BusinessSetting;
use Auth;
use Session;
use DB;
use PDF;
use Mail;
use App\Mail\InvoiceEmailManager;
use CoreComponentRepository;
use Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class OTPVerificationController extends Controller {
    
    protected $redirectTo = '/';
    
    public function __construct()

    {

        //$this->middleware('auth');

        $this->middleware('signed')->only('verify');

        $this->middleware('throttle:6,1')->only('verify', 'resend');

    }
    
     public function send_code($user){

         //$message = rawurlencode('Your one time password is');
         //print_r($user);
         //exit;
         $url = 'http://bulksms.ind.in/api/swsend.asp?username=stitchdeal&password=68253113&sender=StitDL&sendto='.$user->phone.'&message='.rawurlencode($user->message);
         if(!$user->verification_code == null){
             $code = $user->verification_code;
             $url = 'http://bulksms.ind.in/api/swsend.asp?username=stitchdeal&password=68253113&sender=StitDL&sendto='.$user->phone.'&message='.rawurlencode($user->message).'%20'.$code;
         }
         
         
        $ch = curl_init();  
  
        // Return Page contents. 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
          
        //grab URL and pass it to the variable. 
        curl_setopt($ch, CURLOPT_URL, $url); 
          
        $result = curl_exec($ch); 
          
        return $result;
         //print_r($user);
         //exit;
         //return redirect()->to($url);
         
     }
     
     public function verification(){
         //echo "verify now";
         return view('frontend.user_otp');
     }
     
    public function verify_phone(Request $request){
        
        $user = User::where('verification_code', $request->otp)->first();

        if($user != null){

            $user->email_verified_at = Carbon::now();
            
            $user->verification_code = null;

            $user->save();
            
            $user->message = 'Welcome '.$user->name.' you have registered successfully';
            
            $this->send_code($user);

            flash(translate('Your phone number has been verified successfully'))->success();
            return redirect()->route('user.login');
            
        }

        else {

            flash(translate('Sorry, we could not verifiy you. Please try again'))->error();
            return redirect()->route('verification');

        }
        
        
    }
    
    public function resend_verificcation_code(Request $request){
        //$id = auth()->user()->id;
        $phone = $request->session()->get('phone');
        
        //$user = User::findOrFail($id);
        
        
        $view = User::where('phone', $phone)->first();
        $view->phone = $phone;
        $view->verification_code = rand(100000, 999999);
        $view->update();
        
        //$user = User::find($id);
        $user = (object) array(
            'phone' => $phone,
            'verification_code' => $view->verification_code,
            'message' => 'Your one time password is'
        );
        
        //print_r($user);
        //exit;


        //$otpController = new OTPVerificationController;
        $this->send_code($user);
        $request->session()->forget('phone');
        flash(translate('OTP resend successfully'))->success();
        
        return redirect()->route('verification');
        
        //print_r($phone);
    }
    
    public function show_reset_password_form(Request $request){
        //echo "aSas";
        return view('auth.passwords.reset');
    }
    
    public function reset_password_with_code(Request $request){
        $user = Auth::user();
        if (!empty($request->email)) {
            $view = User::where('email', $request->email)->first();
        }else{
            $view = User::where('phone', $request->phone)->first();
        }
        $view->verification_code = null;
        $view->password = Hash::make($request->password);
        $view->update();
        flash(translate('Password reset successfully'))->success();
        return redirect()->route('user.login');
        //exit;
        //print_r($request->all());
        //echo "aSas";
        //return view('auth.passwords.reset');
    }
    
    
    
}