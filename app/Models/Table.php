<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $primaryKey= 'table_id';

    protected $fillable =[
        'type',
        'description',
        'set_num',
        "cafe_id",
        "table_num",
        "price",
        "tableImage"
    ];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

}
