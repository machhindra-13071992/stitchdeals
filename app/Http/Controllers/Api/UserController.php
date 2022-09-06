<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function userShippingCreate(Request $request)
    {
        $insert = DB::table('addresses')->insert(['address'=> $request->address, 'city'=> $request->city, 'country'=> $request->country, 'phone'=> $request->phone, 'postal_code'=> $request->postal_code, 'user_id'=> $request->user_id]); 
        if($insert){
            return response()->json([
                'status' => true,
                'message' => 'Shipping address added successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ]);
        }
    }
    
    public function getShippingAddress($id)
    {
        $addresses = DB::table('addresses')->where('user_id', $id)->get();
        return response()->json([
                'status' => 1,
                'success' => true,              
                'data' => $addresses
            ]);
    }
    
    public function deleteShippingAddress($id)
    {
        // return response()->json('deleteShippingAddress '.$id);
        $delete = DB::table('addresses')->where('id', $id)->delete();
        if($delete){
            return response()->json([
                'status' => true,              
                'message' => "Address Deleted Successfully"
            ]);   
        }else{
            return response()->json([
                'status' => false,              
                'message' => "Something went wrong"
            ]);  
        }
    }
    
    public function info($id)
    {
        return new UserCollection(User::where('id', $id)->get());
    }

    public function updateName(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'name' => $request->name
        ]);
        return response()->json([
            'message' => 'Profile information has been updated successfully'
        ]);
    }

    public function updateShippingAddress(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code
        ]);
        return response()->json([
            'message' => 'Shipping information has been updated successfully'
        ]);
    }
}
