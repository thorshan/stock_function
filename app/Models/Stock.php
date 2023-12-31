<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['name','campus_id', 'level_type', 'quantity', 'price', 'date', 'total_quantity'];

    public function campuses(){
        return $this->belongsTo(Campuses::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
