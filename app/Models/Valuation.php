<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valuation extends Model
{
    use HasFactory;

    protected $fillable = ['valuation', 'comment'];

    public function user()
    {
    return $this->belongsTo('App\Models\user');
    }
    
    public function store()
    {
    return $this->belongsTo('App\Models\store');
    }
}
