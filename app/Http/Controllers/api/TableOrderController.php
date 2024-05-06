<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TableOrder;
use App\Models\Client;

class TableOrderController extends Controller
{
    //
    public function addTableOrder(Request $request)
    {
        // $client = auth()->guard('client')->user();
        $tableOrder = new TableOrder();
    
        $tableOrder->table_id = $request->table_id;
        $tableOrder->descriptionOrder = $request->descriptionOrder;
        $tableOrder->bookingDate=$request->bookingDate;
        $tableOrder->client_id=$request->client_id;
        
        $res=$tableOrder->save();
        if($res)
        {
            return response()->json([
                "Data has been saved"
            ]);
        }
        else{
            return response()->json([
                "the operation failed"
            ]);
        }
    }   

        public function updateTableOrder($id,Request $request)
        {
            // $client = auth()->guard('client')->user();

            
            $tableOrder = TableOrder::find($id);
        
            $tableOrder->table_id = $request->table_id;
            $tableOrder->descriptionOrder = $request->descriptionOrder;
            $tableOrder->bookingDate=$request->bookingDate;
            $tableOrder->client_id=$request->client_id;
    
            $res=$tableOrder->save();
            if($res)
            {
                return response()->json([
                    "Data has been updated"
                ]);
            }
            else{
                return response()->json([
                    "the operation failed"
                ]);
            }

        }

        public function deleteTableOrder($id)
        {
            $res=TableOrder::find($id)->delete();
            if($res)
            {
                return response()->json([
                    "Data has been deleted"
                ]);
            }
            else{
                return response()->json([
                    "the operation failed"
                ]);
            }
            
        }    
}
