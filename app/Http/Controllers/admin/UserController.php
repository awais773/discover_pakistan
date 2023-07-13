<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index()
    {
        $Users=User::latest()->get();
        return view('admin.main.Users',compact('Users'));
    }

   

    public function store(Request $req)
    {
        
        return view('admin.main.Users');
    }

    
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.main.editUser',compact('user'));

    }

    // public function show()
    // {
    //     $user= User::latest()->get();
    //     return view('admin.main.listConfigration', compact('user'));

        
    // }
    

    public function update(Request $request,$id)
    {
        $data = User::find($id);
        $data->update($request->all());
        // $probabilityData = $request->input('probability.data');
        // $data->probability = $probabilityData;
        // $data->save();
        return redirect()->back()->with('message','balance been updated successfully.');
    }


    public function destroy($id) 
    {
       $user = User::where('id', $id)->firstorfail()->delete();
       return redirect()->back()->with('message',"Record deleted successfully");
    }



}
