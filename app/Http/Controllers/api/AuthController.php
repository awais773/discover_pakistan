<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Videos;
use Illuminate\Http\Request;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\DB;
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
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required',
    ]);

    if($validator->fails()){
            return response()->json([
                'success'=>false,
                // 'message' => $validator->errors()->toJson()
                 'message'=> 'Email already exist',
    
            ], 400);
    }

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)         
        ]);
       $token = $user->createToken('Token')->accessToken;
       if (!$user) {
        return response()->json([ 'success'=>false, 'message'=>'somthin Wrong',], 422);
      }
      return response()->json([ 'success'=>true,
      'message'=>'register successfull',
      'data'=>$data=([
        'token'=>$token,
        'user'=>$user
      ])
    
    ], 200);
  }


  public function PasswordChanged(Request $request)
  {
      $this->validate($request, [
          'old_password' => 'required',
      ]);
  
      $user = Auth::user();
      if ($user) {
          // Check if the old password is correct
          if (Hash::check($request->old_password, $user->password)) {
              $user['password'] = Hash::make($request->password);
              $user->save();
  
              return response()->json(['success' => true, 'message' => 'Success! Password has been changed']);
          } else {
              return response()->json(['success' => false, 'message' => 'Failed! Old password is incorrect']);
          }
      }
  
      return response()->json(['success' => false, 'message' => 'Failed! Something went wrong']);
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
                'success'=>true,
                'message'=>'login successfull',
                'data'=>$data = ([
                  'user'=> User::find(Auth::id()),
                  'token'=>$token,
                ])
              
                 ],200);
          } 
          else{
            return response()->json([
                'success'=>false,
                'message'=>'please register'],401);
          }
    }

    public function userinfo()
    {
        $user = auth()->user(); 
        return response()->json(['user'=>$user],200);      

    }



    public function Video(Request $req)
    {
        $video = new Videos();
        $validator = Validator::make($req->all(), [

        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toJson(),
            ], 400);
        }

        $video->video = $req->video;
        $video->shorts_video = $req->shorts_video;
        $video->category = $req->category;
        $video->title = $req->title;
        $video->save();
        return response()->json([
            'success' => true,
            'message' => 'Video Added successfully',
            'data' => $video,
        ], 200);
    }


    public function VideosGet(Request $request)
    {
        $category = $request->input('category');
        $title = $request->input('title');
    
        $query = Videos::query();
    
        if (!is_null($category)) {
            $query->where('category', $category);
        }
    
        if (!is_null($title)) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }
        $videos = $query->select('id','video', 'title' ,'category')->get();
    
        if ($videos->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
            ]);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'All data retrieved successfully',
            'data' => $videos,
        ]);
    }
    

    public function shortsGet(Request $request)
    {
        $category = $request->input('category');
        $title = $request->input('title');
    
        $query = Videos::query();
    
        if (!is_null($category)) {
            $query->where('category', $category);
        }
    
        if (!is_null($title)) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }
        $videos = $query->select('id','shorts_video', 'title' ,'category')->get();
    
        if ($videos->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
            ]);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'All data retrieved successfully',
            'data' => $videos,
        ]);
    }


    

    public function Videos($id)
    {
        $Blog = Videos::find($id);
        if (is_null($Blog)) {
            return response()->json([
                'success' => false,
                'message' => 'data not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $Blog,
        ]);
    }

    
    public function videosDestroy($id)
    {
        $Blog = Videos::find($id);
        if (!empty($Blog)) {
            $Blog->delete();
            return response()->json([
                'success' => true,
                'message' => 'Videos delete successfuly',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'something wrong try again ',
            ]);
        }
    }



    }
