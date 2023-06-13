<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveManagement extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function reserve(){
        return $this->belongsTo(Reserve::class, 'reserve_id','id');
    }
}
