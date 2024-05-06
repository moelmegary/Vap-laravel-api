<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Plane;
class PlaneController extends Controller
{
    //

    public function listPlane()
    {
        $planes = DB::table('planes')->get();
        $data = $planes->map(function ($plane) {
            $plane->planeImage = json_decode($plane->planeImage);
            return $plane;
        });
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
    

    public function addPlane(Request $request)
    {
        $plane = new Plane();
        $plane->nameAr = $request->nameAr;
        $plane->nameEn = $request->nameEn;
        $plane->description = $request->description;
        $plane->price = $request->price;
        $plane->type = $request->type;

        $imagePaths = [];
        if ($request->hasFile('planeImages')) {
            $images = $request->file('planeImages');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
                $imagePaths[] = $imagePath;
            }
        }
    
        $plane->planeImage = json_encode($imagePaths);
        $res = $plane->save();
    
        if ($res) {
            return response()->json([
                "Result" => "Data has been saved"
            ], 200);
        } else {
            return ["Result" => "Data has not been saved"];
        }
    }

    public function updatePlane($id,Request $request)
    {
        $plane = Plane::where('plane_id', $id)->first();
        $plane->nameAr = $request->nameAr;
        $plane->nameEn = $request->nameEn;
        $plane->description = $request->description;
        $plane->price = $request->price;
        $plane->type = $request->type;
    
        $imagePaths = [];
        if ($request->hasFile('planeImages')) {
            $images = $request->file('planeImages');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
                $imagePaths[] = $imagePath;
            }
        }
    
        $plane->planeImage = json_encode($imagePaths);
        $res = $plane->save();
    
        if($res)
        {
             return ['Result'=>"Data has been updated"];
        }
        else
        {
            return ['Result'=>'operati  on has been failed'];
        }
    }

    function deletePlane($id)
    {
        $result=DB::table('planes')->where('plane_id', $id)->delete();        

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
