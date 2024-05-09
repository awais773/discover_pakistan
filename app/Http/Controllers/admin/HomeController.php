<?php

namespace App\Http\Controllers\admin;

use App\Models\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Add;
use App\Models\DiscoverShow;
use App\Models\Home;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function index()
    {
        $Withdraw = Home::where('id', '!=', 1)->get();
        $baners = Home::find(1);
        return view('admin.main.listHome',compact('baners', 'Withdraw'));
    }
    public function Create()
    {
        return view('admin.main.CreateSlider');
    }


    public function store(Request $req)
    {
        $req->validate([
            // 'name' => 'required',
        ]);
        $video = new Home();
        if ($file = $req->file('image')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('Slider/');
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $image = 'Slider/' . $image_full_name;
            $video->slider_image = $image;
        }
        $video->category = $req->category;
        $video->link = $req->link;
        $video->save();
        return redirect()->back()->with('message','Slider Create Sucessfull');
    }



    public function destroy($id)
    {
       $Withdraw = Home::where('id', $id)->firstorfail()->delete();
       return redirect()->back()->with('message',"Record deleted successfully");
    }

    public function edit($id)
    {
        $withdraw = Home::find($id);
        return view('admin.main.CreateBanerTaxt',compact('withdraw'));

    }


    public function update(Request $req,$id)
    {
        $Video = Home::find($id);
    //    if ($file = $req->file('image')) {
    //         $image_name = md5(rand(1000, 10000));
    //         $ext = strtolower($file->getClientOriginalExtension());
    //         $image_full_name = $image_name . '.' . $ext;
    //         $upload_path = public_path('Slider/');
    //         $image_url = $upload_path . $image_full_name;
    //         $file->move($upload_path, $image_full_name);
    //         $image = 'Slider/' . $image_full_name;
    //         $Video->slider_image = $image;
    //     }
            $Video->baner_tax = $req->baner_tax;
            $Video->save();
        return redirect()->back()->with('message','Record has been updated successfully.');
    }



}
