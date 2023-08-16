<?php

namespace App\Http\Controllers\admin;

use App\Models\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Add;
use Illuminate\Support\Facades\Validator;

class AddsController extends Controller
{

    public function index()
    {
        $Withdraw = Add::get();
        return view('admin.main.listAdds',compact('Withdraw',));
    }

    public function addsCreate()
    {
        return view('admin.main.Createadds');
    }


    public function store(Request $req)
    {
        $req->validate([
            // 'name' => 'required',
        ]);
        $video = new Add();
        if ($file = $req->file('image')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('adds/');
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $image = 'adds/' . $image_full_name;
            $video->image = $image;
        }
        $video->save();
        return redirect()->back()->with('message','Adds Create Sucessfull');
    }



    public function destroy($id)
    {
       $Withdraw = Add::where('id', $id)->firstorfail()->delete();
       return redirect()->back()->with('message',"Record deleted successfully");
    }

    public function edit($id)
    {
        $user = Add::find($id);
        return view('admin.main.editWithdraw',compact('user'));

    }


    public function update(Request $req,$id)
    {
        $Video = Add::find($id);
       if ($file = $req->file('image')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('adds/');
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $image = 'deposit/' . $image_full_name;
            $Video->image = $image;
        }
            $Video->save();
        return redirect()->back()->with('message','balance been updated successfully.');
    }


}
