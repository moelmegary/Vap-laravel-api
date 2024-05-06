<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
class CarController extends Controller
{
    //

    public function listCar()
    {
        $cars = DB::table('cars')->get();


        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }


    public function addCar(Request $request)
    {
        $car = new Car();
        $car->nameAr = $request->nameAr;
        $car->nameEn = $request->nameEn;
        $car->description = $request->description;
        $car->price = $request->price;

        $imagePaths = [];
        if ($request->hasFile('carImages')) {
            $images = $request->file('carImages');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
                $imagePaths[] = $imagePath;
            }
        }

        $car->carImage = json_encode($imagePaths);
        $res = $car->save();

        if ($res) {
            return response()->json([
                "Result" => "Data has been saved"
            ], 200);
        } else {
            return ["Result" => "Data has not been saved"];
        }
    }

    public function updateCar($id,Request $request)
    {
        $car = Car::where('car_id', $id)->first();
        $car->nameAr = $request->nameAr;
        $car->nameEn = $request->nameEn;
        $car->description = $request->description;
        $car->price = $request->price;

        $imagePaths = [];
        if ($request->hasFile('carImages')) {
            $images = $request->file('carImages');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
                $imagePaths[] = $imagePath;
            }
        }

        $car->carImage = json_encode($imagePaths);
        $res = $car->save();

        if($res)
        {
             return ['Result'=>"Data has been updated"];
        }
        else
        {
            return ['Result'=>'operati  on has been failed'];
        }
    }

    function deleteCar($id)
    {
        $result=DB::table('cars')->where('car_id', $id)->delete();

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
