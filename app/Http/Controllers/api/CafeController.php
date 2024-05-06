<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cafe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CafeController extends Controller
{
    //
    public function listCafe()
    {
        $cafe = DB::table('cafes')->get();
        return response()->json([
            'status' => 'success',
            'data' => $cafe,
        ]);
    }

    public function addCafe(Request $request)
    {
        $cafe = new Cafe();
        $cafe->nameAr= $request->nameAr;
        $cafe->nameEn= $request->nameEn;
        $cafe->description=$request->description;
        $imageName=time().'.'.$request->cafeImage->extension();
        $request->cafeImage->move(public_path('images'),$imageName);
        $cafe->cafeImage='images/'.$imageName;
        
        $res=$cafe->save();

        if($res)
        {
            return response()->json([
                "Result"=>"Data has been saved"
            ],200);
        }
        else
        {
            return ["Result"=>"Data has not been saved"];
        }
    }


    public function updateCafe($id,Request $request)
    {
        $cafe = Cafe::where('cafe_id', $id)->first();
       if($request->hasFile('cafeImage'))
       {
        $imageName=time().'.'.$request->cafeImage->extension();
        $request->cafeImage->move(public_path('images'),$imageName);
            if($cafe->cafeImage)
            {
                File::delete(public_path('images'),$cafe->cafeImage);
            }
       }  

        $cafe->cafeImage='images/'.$imageName;
        $cafe->nameAr= $request->nameAr;
        $cafe->nameEn= $request->nameEn;
        $cafe->description=$request->description;
        $res=$cafe->save();
        
        if($res)
        {
            return ['Result'=>"Data has been updated"];
        }
        else
        {
            return ['Result'=>'operati  on has been failed'];
        }
        
    }

    function deleteCafe($id)
    {
        $result=DB::table('cafes')->where('cafe_id', $id)->delete();        

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
