<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Invitation;
use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Api\Configration;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmailInvitationController extends Controller
{
    private $success = false;
    private $message = '';

    /**
     * This function is used to return email verification view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        
        $Withdraw = Withdraw::sum('amount');
        $user = User::all()->count();
        $Trading = Withdraw::sum('amount');
        $Deposit = Withdraw::sum('amount');

        
        return view('admin.main.indexs',compact('Trading','user','Withdraw','Deposit'));
    }

    /**
     * This is used to send invitation link
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendInvitation(Request $request)
    {
        $email = $request->input('email');
        $this->message = 'Enter user email';
        $this->success = false;
        if (!empty($email)) {
            $obj = new Invitation();
            $obj->name = $request->input('name');
            $obj->email = $request->input('email');
            $obj->save();
            Mail::to($email)->send(new InvitationMail(Auth::user()));
            $this->message = 'Invitation sent successfully';
            $this->success = true;
        }

        return response()->json(['success' => $this->success, 'message' => $this->message]);
    }

    public function changePassword()
    {
       return view('admin.main.change-password');
    }
    
    public function updatePassword(Request $request)
    {
            # Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);
    
    
            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }
    
    
            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
    
            return back()->with("status", "Password changed successfully!");
    }
    
}
