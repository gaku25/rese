<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['store', 'overview', 'image'];

    public function area(){
        return $this->belongsTo(Area::class, 'area_id','id');
    }

    public function genre(){
        return $this->belongsTo(Genre::class, 'genre_id','id');
    }

    public function valuation(){
        return $this->hasMany('App\Models\valuation');
    }

    public function favorites(){
    return $this->hasMany(Favorite::class, 'store_id');
}
}
