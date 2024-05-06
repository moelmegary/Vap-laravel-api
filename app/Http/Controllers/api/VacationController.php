<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vacation;

class VacationController extends Controller
{
    //

    public function listVacation()
    {
        $vacations = DB::table('vacations')->get();
        $data = $vacations->map(function ($vacation) {
            $vacation->vacationImage = json_decode($vacation->vacationImage);
            return $vacation;
        });
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
    

    public function addVacation(Request $request)
    {
        $vacation = new Vacation();
        $vacation->nameAr = $request->nameAr;
        $vacation->nameEn = $request->nameEn;
        $vacation->description = $request->description;
        $vacation->price = $request->price;
        $vacation->day_num = $request->day_num;    
        $imagePaths = [];
        if ($request->hasFile('vacationImages')) {
            $images = $request->file('vacationImages');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
                $imagePaths[] = $imagePath;
            }
        }
    
        $vacation->vacationImage = json_encode($imagePaths);
        $res = $vacation->save();
    
        if ($res) {
            return response()->json([
                "Result" => "Data has been saved"
            ], 200);
        } else {
            return ["Result" => "Data has not been saved"];
        }
    }

    public function updateVacation($id,Request $request)
    {
        $vacation = Vacation::where('vacation_id', $id)->first();
        $vacation->nameAr = $request->nameAr;
        $vacation->nameEn = $request->nameEn;
        $vacation->description = $request->description;
        $vacation->price = $request->price;
        $vacation->day_num = $request->day_num;    
        $imagePaths = [];
        if ($request->hasFile('vacationImages')) {
            $images = $request->file('vacationImages');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
                $imagePaths[] = $imagePath;
            }
        }
    
        $vacation->vacationImage = json_encode($imagePaths);
        $res = $vacation->save();
    
        if($res)
        {
             return ['Result'=>"Data has been updated"];
        }
        else
        {
            return ['Result'=>'operati  on has been failed'];
        }
    }

    function deleteVacation($id)
    {
        $result=DB::table('vacations')->where('vacation_id', $id)->delete();        

        if($result)
        {
            return response()->json([
                "the Data has been deleted"
            ],200) ;            
        }

        else
        {
            return response()->json([
                "the operation failed"
            ],401) ;
        }
    }
}
