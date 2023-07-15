<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class Store extends Model
{
    use HasFactory;

    public $isFavorite;

    protected $fillable = ['store', 'overview', 'image'];

    public function area(){
        return $this->belongsTo(Area::class, 'area_id','id');
    }

    public function genre(){
        return $this->belongsTo(Genre::class, 'genre_id','id');
    }

    protected $table = 'stores';

    public function reserves()
    {
        return $this->hasMany(Reserve::class, 'store_id', 'id');
    }

    public function favorites(){
        return $this->hasMany(Favorite::class, 'store_id','id');
    }
}
