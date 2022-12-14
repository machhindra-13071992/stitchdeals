<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Http\Controllers\Api;

use App\Models\BusinessSetting;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OTPVerificationController;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        /*$request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);*/
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                return response()->json([
                'message' => 'Email already exists.','error'=>'1'
            ], 201);
            }
        }
        
        /*if (User::where('phone',$request->phone)->first() != null) {
             return response()->json([
                'message' => 'Phone already exists.','error'=>'1'
            ], 201);
        }*/
        
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => isset($request->phone) ? $request->phone : null,
            'password' => bcrypt($request->password),
            'email_verified_at' => Carbon::now(),
            'verification_code' => rand(100000, 999999)
        ]);
        $user->save();
        $customer = new Customer;
        $customer->user_id = $user->id;
        $customer->save();
        
        if(!empty($request->phone)){
            $otpController = new OTPVerificationController;
            $otpController->send_code($user);
            return response()->json([
            'message' => 'Registration Successful. Please log in to your account','error'=>'0','otp_send'=>'1','phone'=>$user->phone,'verification_code'=>$user->verification_code
        ], 201);
        }else{
                return response()->json([
                'message' => 'Registration Successful. Please log in to your account','error'=>'0','otp_send'=>'0'
            ], 201);
        }
    }

    public function login(Request $request)
    {
        /*$request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);*/
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        return $this->loginSuccess($tokenResult, $user);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);
        if (User::where('email', $request->email)->first() != null) {
            $user = User::where('email', $request->email)->first();
        } else {
            $user = new User([
                'name' => $request->name,
                'email' => $request->email,
                'provider_id' => $request->provider,
                'email_verified_at' => Carbon::now()
            ]);
            $user->save();
            $customer = new Customer;
            $customer->user_id = $user->id;
            $customer->save();
        }
        $tokenResult = $user->createToken('Personal Access Token');
        return $this->loginSuccess($tokenResult, $user);
    }

    protected function loginSuccess($tokenResult, $user)
    {
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(100);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user' => [
                'id' => $user->id,
                'type' => $user->user_type,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'avatar_original' => $user->avatar_original,
                'address' => $user->address,
                'country'  => $user->country,
                'city' => $user->city,
                'postal_code' => $user->postal_code,
                'phone' => $user->phone
            ]
        ]);
    }
}
