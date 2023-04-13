<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
    //

    public function listUser(){

        $user = DB::table('users')->get();
        return response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
        
    }

    public function createUser(Request $request)
    {
        $userData=$request->validate(
            [
                'name'=>'required | string',
                'email'=>'required | string |email |unique:users,email',
                'password'=>'required |min:6',
            ]
            );

            $user=User::create(
                [
                    "name"=>$userData["name"],
                    "email"=>$userData["email"],
                    "password"=>bcrypt($userData["password"]),
                    "gender"=>$request->gender,
                    "phone"=>$request->phone,
                    "location"=>$request->location,
                    "role_id"=>$request->role_id
                ]
                );

                if($user)
                {
                    return response()->json([
                        "msg"=>"created successfully",
                        "token"=>$user->createToken('token')->plainTextToken 
                    ]);
                }
                    }
    public function signin(Request $request){
        // 1- validate data
        $userData = $request->validate([
            "name"=> "required | string",
            "password"=>"required | string | min: 6",
        ]);
        // check the email  in database 
        $user = User::where("name", $userData["name"])->firstOrFail();
        // check the email and password
        if(!auth()->attempt($request->only("name","password"))) {
        return response()->json([
            "msg"=> "invalid Data",
        ], 401);
        }
        // send token 
        if($userData){
            return response()->json([
                "msg"=> "login succusfully",
                "token"=>$user->createToken("token")->plainTextToken 
            ]);
        }
    }

//    public function listUser(){
//           return user::all();  
//     }
}
