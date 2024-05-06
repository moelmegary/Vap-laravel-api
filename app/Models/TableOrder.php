<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOrder extends Model
{
    use HasFactory;
    protected $primaryKey ='tableOrder_id';
    protected $fillable = [
        "table_id",
        "descriptionOrder",
        "bookingDate",
        "client_id"
    ];
}
