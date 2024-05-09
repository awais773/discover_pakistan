<?php

namespace App\Http\Controllers\admin;

use App\Models\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{

    public function index()
    {
        $Withdraw = Topic::get();
        return view('admin.main.listTopic',compact('Withdraw',));
    }

    public function Create()
    {
        return view('admin.main.CreateTopic');
    }


    public function store(Request $req)
    {
        $req->validate([
            // 'name' => 'required',
        ]);
        $video = new Topic();
        if ($file = $req->file('image')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('topic/');
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $image = 'topic/' . $image_full_name;
            $video->image = $image;
        }
        $video->category = $req->category;
        $video->video = $req->video;
        $video->short_video = $req->short_video;
        $video->save();
        return redirect()->back()->with('message','Data Create Sucessfull');
    }


    public function edit($id)
    {
        $Add = Topic::find($id);
        return view('admin.main.Createadds',compact('Add'));

    }


    public function update(Request $req,$id)
    {
        $Video = Topic::find($id);
        if ($file = $req->file('image')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('adds/');
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $image = 'adds/' . $image_full_name;
            $Video->image = $image;
        }
        $Video->category = $req->category;
        $Video->save();
        return redirect()->back()->with('message','Record has been added successfully.');
    }


    public function destroy($id)
    {
       $Withdraw = Topic::where('id', $id)->firstorfail()->delete();
       return redirect()->back()->with('message',"Record deleted successfully");
    }



}
