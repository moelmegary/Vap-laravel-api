<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HotelController extends Controller
{
    //
    public function listHotel()
    {
        $hotels = DB::table('hotels')->get();
        $data = $hotels->map(function ($hotel) {
            $hotel->hotelImage = json_decode($hotel->hotelImage);
            return $hotel;
        });
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }


    public function addHotel(Request $request)
    {
        $hotel = new Hotel();
        $hotel->hotelName = $request->hotelName;
        $hotel->roomType = $request->roomType;
        $hotel->description = $request->description;
        $hotel->sleeps = $request->sleeps;
        $hotel->price = $request->price;

        $imagePaths = [];
        if ($request->hasFile('hotelImages')) {
            $images = $request->file('hotelImages');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
                $imagePaths[] = $imagePath;
            }
        }

        $hotel->hotelImage = json_encode($imagePaths);
        $res = $hotel->save();

        if ($res) {
            return response()->json([
                "Result" => "Data has been saved"
            ], 200);
        } else {
            return ["Result" => "Data has not been saved"];
        }
    }

    public function updateHotel($id,Request $request)
    {
        $hotel = Hotel::where('hotel_id', $id)->first();
        $hotel->hotelName = $request->hotelName;
        $hotel->roomType = $request->roomType;
        $hotel->description = $request->description;
        $hotel->sleeps = $request->sleeps;
        $hotel->price = $request->price;

        $imagePaths = [];
        if ($request->hasFile('hotelImages')) {
            $images = $request->file('hotelImages');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;
                $imagePaths[] = $imagePath;
            }
        }

        $hotel->hotelImage = json_encode($imagePaths);
        $res = $hotel->save();

        if($res)
        {
             return ['Result'=>"Data has been updated"];
        }
        else
        {
            return ['Result'=>'operati  on has been failed'];
        }
    }

    function deleteHotel($id)
    {
        $result=DB::table('hotels')->where('hotel_id', $id)->delete();

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
