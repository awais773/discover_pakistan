<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Api\Product;
use Illuminate\Http\Request;
use App\Mail\OtpVerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'min:4', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',],
            'password' => ['required', 'string', 'min:8'],
            'country' => ['required'],

      ]);

      if($validator->fails()){
          return response()->json($validator->errors());       
      }

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'country'=> $request->country,
            'password'=> Hash::make($request->password)         
        ]);
       $token = $user->createToken('Token')->accessToken;
       if (!$user) {
        return response()->json([ 'success'=>'Falls', 'message'=>'somthin Wrong',], 422);
      }
      return response()->json([ 'success'=>'True',
      'message'=>'register successfull',
      'token'=>$token,'user'=>$user], 200);

    //    return response()->json([
    //     'success'=>'True',
    //     'message'=>'register successfull',
    //     'token'=>$token,'user'=>$user],200);
    }

    public function login(Request $request)
    {
        $data=[
            'email'=>$request->email,
            'password'=>$request->password
        ];

          if(auth()->attempt($data))
          {
             $token = auth()->user()->createToken('Token')->accessToken;
             return response()->json([
                'success'=>'True',
                'message'=>'login successfull',
              'user'=> User::find(Auth::id()),
                'token'=>$token,
                 ],200);
          } 
          else{
            return response()->json([
                'success'=>'Falls',
                'message'=>'please register'],401);
          }
    }

    public function userinfo()
    {
        $user = auth()->user(); 
        return response()->json(['user'=>$user],200);      

    }
}
