<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reserve;

class ReserveManagement extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'user_id', 
        'store_id',
    ];

}
