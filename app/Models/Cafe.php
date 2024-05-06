<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;
    protected $table='cafes';
    protected $primaryKey = 'cafe_id';
        protected $fillable = [
        'nameAr',
        'nameEn',
        'description',
        'cafeImage'
    ];

    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
