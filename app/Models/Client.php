<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;


class Client extends Model
{
    use HasFactory,HasApiTokens;
    use Notifiable;
    protected $primaryKey = 'client_id';
    protected $fillable = [
        'clientName',
        'email',
        'password',
        "phone",
        "location",
        "gender",
    ];
}
