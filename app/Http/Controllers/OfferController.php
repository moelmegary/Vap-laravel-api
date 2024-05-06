<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Offer;

class OfferController extends Controller
{
    //
    public function offerShow(){
        return Offer::get();
 
     }
}
