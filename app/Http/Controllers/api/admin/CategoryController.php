<?php

namespace App\Http\Controllers\admin;

use App\Models\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Add;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index()
    {
        $Withdraw = Category::get();
        return view('admin.main.listCategory',compact('Withdraw'));
    }

    public function create()

    {
        return view('admin.main.CreateCategory');
    }

    public function store(Request $req)
    {
        $req->validate([
            // 'name' => 'required',
        ]);
        $video = new Category();
        $video->name = $req->name;
        if ($file = $req->file('icon')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('icons/');
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $image = 'icons/' . $image_full_name;
            $video->icon = $image;
        }
        $video->save();
        return redirect()->back()->with('message','Category Create Sucessfull');
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.main.EditCategory',compact('category'));
    }


    public function update(Request $req,$id)
    {
        $Video = Category::find($id);
        $Video->name = $req->name;
        if ($file = $req->file('icon')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('icons/');
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $image = 'icons/' . $image_full_name;
            $Video->icon = $image;
        }
        $Video->save();
        return redirect()->route('category.index')  ->with('message','Record has been added successfully.');
    }


    public function destroy($id)
    {
       $Withdraw = Category::where('id', $id)->firstorfail()->delete();
       return redirect()->back()->with('message',"Record deleted successfully");
    }



}
