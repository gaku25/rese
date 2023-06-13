<?php

namespace App\Models;
use App\Models\User;
use App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function store(){
        return $this->belongsTo(Store::class, 'store_id','id');
    }
}
