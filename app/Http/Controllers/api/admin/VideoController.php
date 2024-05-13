<?php

namespace App\Http\Controllers\admin;

use App\Models\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Videos;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
   
    public function index()
    {
        $Withdraw = Videos::with('user')->get();
        return view('admin.main.listVideo',compact('Withdraw',));
    }

    public function Videocreate()
    {
        $Category = Category::latest()->get();
        return view('admin.main.addVideo',compact('Category'));
    }


    public function store(Request $req)
    {
        $req->validate([
            // 'name' => 'required',
        ]);
        $Videos = new Videos();
        $Videos->title = $req->title;
        $Videos->shorts_video = $req->shorts_video;
        $Videos->video = $req->video;
        $Videos->category = $req->category;
        $Videos->type = $req->type;
        $Videos->description = $req->description;
        $Videos->save();
        return redirect()->back()->with('message','Videos Create Sucessfull');
    }



    public function destroy($id) 
    {
       $Withdraw = Videos::where('id', $id)->firstorfail()->delete();
       return redirect()->back()->with('message',"Record deleted successfully");
    }

    public function edit($id)
    {
        $user = Withdraw::find($id);
        return view('admin.main.editWithdraw',compact('user'));

    }


    public function update(Request $request,$id)
    {
        $data = Withdraw::find($id);
        $data->update($request->all());

        return redirect()->back()->with('message','balance been updated successfully.');
    }


}
