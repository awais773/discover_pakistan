<?php

namespace App\Http\Controllers\admin;

use App\Models\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Add;
use App\Models\Job;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{

    public function index()
    {
        $Withdraw = Job::get();
        return view('admin.main.listJob',compact('Withdraw'));
    }

    public function create()

    {
        return view('admin.main.CreateJob');
    }

    public function store(Request $req)
    {
        $req->validate([
            // 'name' => 'required',
        ]);
        $video = new Job();
        $time = $req->input('time');
        $timePeriod = $req->input('time_period');
        $video->title = $req->title;
        $timeWithPeriod  = $time . ' ' . $timePeriod;
        $video->time = $timeWithPeriod;
        $video->save();
        return redirect()->back()->with('message','Job Create Sucessfull');
    }


    public function edit($id)
    {
        $Job = Job::find($id);
        return view('admin.main.EditJob',compact('Job'));
    }


    public function update(Request $req,$id)
    {
        $Video = Job::find($id);
        $time = $req->input('time');
        $timePeriod = $req->input('time_period');
        $Video->title = $req->title;
        $timeWithPeriod  = $time . ' ' . $timePeriod;
        $Video->time = $timeWithPeriod;
        $Video->save();
        return redirect()->route('Job.index')  ->with('message','Record has been added successfully.');
    }


    public function destroy($id)
    {
       $Withdraw = Job::where('id', $id)->firstorfail()->delete();
       return redirect()->back()->with('message',"Record deleted successfully");
    }



}
