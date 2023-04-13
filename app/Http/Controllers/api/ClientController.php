<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;




class ClientController extends Controller
{
    //

    public function listClient(){

        $client = DB::table('clients')->get();
        return response()->json([
            'status' => 'success',
            'data' => $client,
        ]);
        
    }


    public function addClient(Request $req)
    {
        $userData = [
            'clientName'    => $req->clientName,
            'phone'    => $req->phone,
            'email'    => $req->email,
            'password' => $req->password,
        ];
    
        $rules = [
            'clientName'     =>'required | string',
            'phone'     =>'required|numeric|digits:11',
            'email'    => 'required|email |unique:clients,email',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must co    ntain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ];
    
        $validation = Validator::make( $userData, $rules );
    
        if ( $validation->fails() ) {
            return $validation->errors()->all();
        }

        $client = new Client;
        $client->clientName= $req->clientName;
        $client->phone=$req->phone;
        $client->gender=$req->gender;
        $client->location=$req->location;
        $client->email=$req->email;
        $client->password=bcrypt($req["password"]);

        $res=$client->save();
        

        if($res)
        {
            return  response()->json([
                ["Result"=>"Data has been saved"]
            ],200);
        }
        else
        {
            return response()->json([
                "the operation failed"
            ],401);
        }
    }

    public function updateClient($id,Request $req)
    {
        $clients=DB::table('clients')->where('client_id', $id);
        $res=$clients->update([

       "clientName"=> $req->clientName,
       "phone"=>$req->phone,
       "gender"=>$req->gender,
       "location"=>$req->location,
       "email"=>$req->email,
       "password"=>bcrypt($req["password"])

            ]);
        
        if($res)
        {
            return ['Result'=>"Data has been updated"];
        }
        else
        {
            return ['Result'=>'operation has been failed'];
        }
        
    }

    function deleteClient($id)
    {
        $result=DB::table('clients')->where('client_id', $id)->delete();        
        if($result)
        {
            return response()->json([
                "the Client has been deleted"
            ],200);
        }
        else
        {
            return response()->json([
                "the operation failed"
            ],401);
        }
    }    

    public function signinClient(Request $request)
    {
        
       
        $client = Client::where('clientName', $request->clientName)->first();
        if (empty($client)) {
            return response()->json([
                'message' => 'Check Your Name',
            ], 401);
        }
        

            
    
        if (! $client || ! Hash::check($request->password, $client->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    
        $token = $client->createToken('auth_token', ['client'])->plainTextToken;
    
        return response()->json([
            'message' => 'Successfully logged in',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }



}
