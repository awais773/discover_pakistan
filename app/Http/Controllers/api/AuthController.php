<?php

namespace App\Http\Controllers\api;

use App\Models\Add;
use App\Models\Home;
use App\Models\User;
use App\Models\Videos;
use App\Models\Contact;
use App\Mail\ContactMail;
use App\Models\Adverstise;
use Illuminate\Http\Request;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\CareerMail;
use App\Models\Category;
use App\Models\Job;
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
            'social_type'=> $request->social_type,
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


public function login(Request $request)
{
    $credentials = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    $user = User::where('email', $request->email)
                 ->first();
    if ($user && ($user->social_type === 'google')) {
        $token = $user->createToken('Token')->accessToken;
        return response()->json([
            'success' => true,
            'message'=>'login successfull',
                'data'=>$user = ([
                    'user' => $user,
                    'token'=>$token,
                ])
        ], 200);
    } elseif (auth()->attempt($credentials)) {
        $user = auth()->user();
        $token = $user->createToken('Token')->accessToken;
        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data'=>$user = ([
                'user'=> User::find(Auth::id()),
                'token'=>$token,
              ])
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'error' => 'Unauthorized',
            'message' => 'please register',
        ], 401);
    }
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


    // public function login(Request $request)
    // {
    //     $data=[
    //         'email'=>$request->email,
    //         'password'=>$request->password
    //     ];

    //       if(auth()->attempt($data))
    //       {
    //          $token = auth()->user()->createToken('Token')->accessToken;
    //          return response()->json([
    //             'success'=>true,
    //             'message'=>'login successfull',
    //             'data'=>$data = ([
    //               'user'=> User::find(Auth::id()),
    //               'token'=>$token,
    //             ])
              
    //              ],200);
    //       } 
    //       else{
    //         return response()->json([
    //             'success'=>false,
    //             'message'=>'please register'],401);
    //       }
    // }

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
        $video->type = $req->type;
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
    
        $query = Videos::query()->whereNotNull('video');
    
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
    
        $query = Videos::query()->whereNotNull('shorts_video');
    
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


    public function allVideo(Request $request)
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
        $videos = $query->select('id','shorts_video', 'video' ,'title' ,'category')->get();
    
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

    
    public function HomeVideo(Request $request)
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
    
        $videos = $query
            ->select('id', 'shorts_video', 'video', 'title', 'category')
            ->orderBy('created_at', 'desc') // Assuming 'created_at' is the timestamp column for video creation
            ->limit(16)
            ->get();
    
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

    public function addShow($id)
    {
        $Blog = Add::find($id);
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

    public function addsGet(Request $request)
    {
        $category = $request->input('category');
        $query = Add::query();
        $query->whereNotNull('category');
        if (!is_null($category)) {
            $query->where('category', $category);
        }
        $videos = $query->select('id','category', 'image')->get();
    
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


    


    public function email(Request $req)
    {
        // Check if a file has been uploaded
        $attachmentPath = null;
        if ($file = $req->file('file')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('Document/');
            $file->move($upload_path, $image_full_name);
            $attachmentPath = 'Document/' . $image_full_name;
        }

        // Create the email and send it
        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'contact_number' => $req->contact_number,
            'city' => $req->city,
            'subject' => $req->subject,
            'message' => $req->message,
            'attachment' => $attachmentPath,
        ];    
        Mail::to('discoverpakistanhdtv@gmail.com')->send(new CareerMail ($data) );

        return response()->json([
            'success' => true,
            'message' => 'Email sent successfully',
        ], 200);
    }

    public function Contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => $validator->errors()->toJson()
                'message' => 'Email already exist',

            ], 400);
        } {
       $driver = Contact::create($request->post());        
        if ($file = $request->file('Contact')) {
            $video_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $video_full_name = $video_name . '.' . $ext;
            $upload_path = 'Contact/';
            $video_url = $upload_path . $video_full_name;
            $file->move($upload_path, $video_url);
            $driver->image = $video_url;
        }

      $driver->save();
            return response()->json([
                'success' => true,
                'message' => 'Contact Create successfull',
                  'data'  =>$driver,
            ], 200);
        }
    }


    
    public function Adverstise(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|string|email|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => $validator->errors()->toJson()
                'message' => 'Email already exist',

            ], 400);
        } {
       $driver = Adverstise::create($request->post());        
        if ($file = $request->file('Adverstise')) {
            $video_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $video_full_name = $video_name . '.' . $ext;
            $upload_path = 'Adverstise/';
            $video_url = $upload_path . $video_full_name;
            $file->move($upload_path, $video_url);
            $driver->image = $video_url;
        }

      $driver->save();
            return response()->json([
                'success' => true,
                'message' => 'Adverstise Create successfull',
                  'data'  =>$driver,
            ], 200);
        }
    }


    public function stripePost(Request $request)
    {
        try {
            // Set Stripe API secret key
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
            // Convert the amount to cents
            $amountInCents = $request->amount * 100;
    
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $amountInCents,
                'currency' => 'usd',
                'payment_method_types' => ['card'], // Add the payment method type here
            ]);
            // Return success response if the charge was successful
            return response([
                'success' => true,
                'message' => 'Payment Successful',
                'data' => $intent->client_secret,
            ], 201);
        } catch (\Exception $e) {
            // Return error response if an exception occurs during payment processing
            return response([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }

//     public function checkPayment(Request $req)
//     {
//     try {
//         // Set Stripe API secret key
//         \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
//         // Create a PaymentIntent with Stripe
//         $intent = \Stripe\PaymentIntent::create([
//             'amount' => $req->amount,
//             'currency' => 'usd',
//         ]);
//         // Check if PaymentIntent creation was successful
//         if ($intent->status !== 'requires_payment_method') {
//             return response([
//                 'success' => false,
//                 'error' => 'PaymentIntent creation failed. Please try again later.'
//             ], 400);
//         }
//     } catch (\Exception $e) {
//         // Return error response if an exception occurs during payment processing
//         return response([
//             'success' => false,
//             'error' => $e->getMessage()
//         ], 400);
//     } 
// }


    public function checkPayment(Request $req,)
    {
        $id = $req->user()->id;
        $validator = Validator::make($req->all(), [
            // 'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        // Retrieve the Payment Intent using the provided client_secret
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent = \Stripe\PaymentIntent::retrieve($req->client_secret);
        if ($paymentIntent->status === 'succeeded') {
            // Payment succeeded, update the invoice status
              $payment = User::find($id);
              $payment->primimum = 'primimum';     
              $payment->amount = $req->amount;     
               $payment->save();
            return response()->json([
                'success' => true,
                'message' => 'Payment Successful',
                'data' => $payment
            ], 200);
        } else {
            // Payment incomplete or failed, show a message
            return response()->json([
                'success' => false,
                'message' => 'Payment Incomplete'
            ], 400);
        }
    }

    public function bannerTaxt()
    {
        $Blog = Home::where('id', 1)->first();
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


    // public function SliderImage()
    // {
    //     $Blog = Home::where('id', '!=', 1)->get();
    //     if (is_null($Blog)) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'data not found'
    //         ], 404);
    //     }
    //     return response()->json([
    //         'success' => true,
    //         'data' => $Blog,
    //     ]);
    // }

    public function SliderImage()
    {
        $blogs = Home::where('id', '!=', 1)
                     ->whereNull('category')  // Add this line to filter out null categories
                     ->get();
    
        if ($blogs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }



    public function DiscoverShowSlider()
    {
        $blogs = Home::where('id', '!=', 1)
                     ->whereNotNull('category')  // Add this line to filter out null categories
                     ->get();
    
        if ($blogs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found'
            ], 404);
        }
    
        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }



        public function DiscoverShowImages()
        {
            $blogs = Add::whereNotNull('link')  // Add this line to filter out null categories
                        ->get();
        
            if ($blogs->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found'
                ], 404);
            }
        
            return response()->json([
                'success' => true,
                'data' => $blogs,
            ]);
        }


        public function Category()
        {
            $blogs = Category::latest()->get();
            if ($blogs->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found'
                ], 404);
            }
        
            return response()->json([
                'success' => true,
                'data' => $blogs,
            ]);
        }



        public function Job()
        {
            $blogs = Job::latest()->get();
            if ($blogs->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found'
                ], 404);
            }
        
            return response()->json([
                'success' => true,
                'data' => $blogs,
            ]);
        }



     
}
