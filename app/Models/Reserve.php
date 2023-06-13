<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = ['datetime', 'time','number'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function store(){
        return $this->belongsTo(Store::class, 'store_id','id');
    }
}
