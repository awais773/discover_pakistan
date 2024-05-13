<?php

namespace App\Http\Controllers\admin;

use App\Models\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Add;
use Illuminate\Support\Facades\Validator;

class AddsController extends Controller
{

      public function index()
    {
        $Withdraw = Add::whereNull('link')  // Add this line to filter out null categories
        ->get();
        $discover = Add::whereNotNull('link')->get();
        return view('admin.main.listAdds',compact('Withdraw','discover'));
    }

    public function addsCreate()
    {
                $Category = Category::latest()->get();
        return view('admin.main.CreateDiscoverImages',compact('Category'));
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
        if ($file = $req->file('mobile_image')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('adds/');
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $image = 'adds/' . $image_full_name;
            $video->mobile_image = $image;
        }
        $video->category = $req->category;
         $video->link = $req->link;
         $video->links = $req->links;
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
        $Add = Add::find($id);
        return view('admin.main.Createadds',compact('Add'));

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
            $image = 'adds/' . $image_full_name;
            $Video->image = $image;
        }

        if ($file = $req->file('mobile_image')) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = public_path('adds/');
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $image = 'adds/' . $image_full_name;
            $Video->mobile_image = $image;
        }
        $Video->category = $req->category;
        $Video->link = $req->link;
        $Video->links = $req->links;
        $Video->save();
        return redirect()->back()->with('message','Record has been added successfully.');
    }



}
