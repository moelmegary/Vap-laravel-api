<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Table;
use App\Models\Cafe;
use Illuminate\Support\Facades\File;

class TableController extends Controller
{
    //

    public function listTable($id)
    {
        $checktables = Cafe::find($id);
        if (empty($checktables)) {
            return response()->json([
                "there is no table"   
            ],401);
        }
    
        $table = Table::join('cafes', 'cafes.cafe_id', '=', 'tables.cafe_id')
        ->select('tables.*', 'cafes.*')
        ->where('tables.cafe_id', $id)
        ->get();
    
        return response()->json([
            'status' => 'success',
            'data' => $table,
        ]);
    }

    public function addTable(Request $request)
    {
        $table = new Table();
        $table->table_num= $request->table_num;
        $table->type= $request->type;
        $imageName=time().'.'.$request->tableImage->extension();
        $request->tableImage->move(public_path('images'),$imageName);
        $table->tableImage='images/'.$imageName;
        $table->description=$request->description;
        $table->set_num=$request->set_num;
        $table->cafe_id=$request->cafe_id;
        $table->price=$request->price;
        $res=$table->save();

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


    public function updateTable($id,Request $request)
    {
        $table = Table::where('table_id', $id)->first();
        if($request->hasFile('tableImage'))
        {
            $imageName=time().'.'.$request->tableImage->extension();
            $request->tableImage->move(public_path('images'),$imageName);
            if($table->tableImage)
            {
                File::delete(public_path('images'),$table->tableImage);
            }
        }

        $table->tableImage='images/'.$imageName;
        $table->table_num= $request->table_num;
        $table->type= $request->type;
        $table->description=$request->description;
        $table->set_num= $request->set_num; 
        $table->price=$request->price;
        $res=$table->save();
        
        if($res)
        {
             return ['Result'=>"Data has been updated"];
        }
        else
        {
            return ['Result'=>'operati  on has been failed'];
        }
        
    }

    function deleteTable($id)
    {
        $result=DB::table('tables')->where('table_id', $id)->delete();        

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
