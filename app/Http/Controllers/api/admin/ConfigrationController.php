<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Api\Configration;
use App\Models\Api\DailyBonus;

class ConfigrationController extends Controller
{
   
    public function index()
    {
        $category = Configration::latest()->get();
        return view('admin.main.index');
    }

    public function create()
    {
        return view('admin.main.addConfigration');
    }



    public function store(Request $request)
    {
        // $probabilityData = $request->input('probability.data');
        // $requestData = $request->post();
        // $requestData['probability'] = $probabilityData;
        // Configration::create($requestData);

        $LeaderBoard = Configration::create($request->post());
        $LeaderBoard->save();
  
    
        return redirect()->back()->with('message', 'Configuration has been created successfully.');
    }
    

    public function show()
    {
        $category= Configration::latest()->get();
        return view('admin.main.listConfigration', compact('category'));

        
    }
  

    public function destroyCategory($id) 
    {
       $user = Configration::where('id', $id)->firstorfail()->delete();
       return redirect()->back()->with('message',"Record deleted successfully");
    }


    public function edit($id)
    {
        $category = Configration::find($id);
        return view('admin.main.editConfigration',compact('category'));

    }


    public function update(Request $request,$id)
    {
        $data = Configration::find($id);
        $data->update($request->all());
        // $probabilityData = $request->input('probability.data');
        // $data->probability = $probabilityData;
        // $data->save();
        return redirect()->back()->with('message','Configration been updated successfully.');
    }

    public function dailyBounsCreate()
    {
        return view('admin.main.addDailyBouns');
    }

    public function adddailyBouns(Request $request)
    {
        $request->validate([
        ]);

        if ($request->levels) {
            $floaringString = implode(",", $request->get('levels'));
        } else {
            $floaringString = "NULL";
        }
        $postCreated = DailyBonus::create([
            "x" => $request->x,
            "y" => $request->y,
            "z" => $request->z,
            "levels" => $floaringString,
            "advance_level" => $request->advance_level,
            "complete_level" => $request->complete_level,
            "show_advertising" => $request->show_advertising,
        ]);

        // DailyBonus::create($request->post());
        
        return redirect()->back()->with('message','DailyBonus been created successfully.');
    }


    public function listDailyBouns(){
        $dailyBouns = DailyBonus::get();
        return view('admin.main.listDailyBouns', compact('dailyBouns'));
    }

    public function DailyBounsedit($id)
    {
        $dailyBouns = DailyBonus::find($id);
        return view('admin.main.editDailyBouns',compact('dailyBouns'));

    }


    public function DailyBounsupdate(Request $request,$id)
    {
        $request->validate([
            'e1' => 'required|integer',
            'e2' => 'required|integer',
            'e3' => 'required|integer',
            'e4' => 'required|integer',
            'e5' => 'required|integer',
            'e6' => 'required|integer',
            'e7' => 'required|integer',
            'd1' => 'required|integer',
            'd2' => 'required|integer',
            'd3' => 'required|integer',
            'd4' => 'required|integer',
            'd5' => 'required|integer',
            'd6' => 'required|integer',
            'd7' => 'required|integer',
            'g1' => 'required|integer',
            'g2' => 'required|integer',
            'g3' => 'required|integer',
            'g4' => 'required|integer',
            'g5' => 'required|integer',
            'g6' => 'required|integer',
            'g7' => 'required|integer',
        ]);
        $data = DailyBonus::find($id);
        $data->update($request->all());
        return redirect()->back()->with('message','DailyBonus been updated successfully.');
    }


    public function destroyDailyBouns($id) 
    {
       $user = DailyBonus::where('id', $id)->firstorfail()->delete();
       return redirect()->back()->with('message',"Record deleted successfully");
    }


    public function showAdvertising($id)
    {
        $dailyBouns = DailyBonus::find($id);
        return view('admin.main.showAdtervisingEditDailyBouns',compact('dailyBouns'));   
     }

     public function z($id)
     {
         $dailyBouns = DailyBonus::find($id);
         return view('admin.main.zEditDailyBouns',compact('dailyBouns'));   
      }

      public function complete($id)
      {
          $dailyBouns = DailyBonus::find($id);
          return view('admin.main.completeEditDailyBouns',compact('dailyBouns'));   
       }
  


}
