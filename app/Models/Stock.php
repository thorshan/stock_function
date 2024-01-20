<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['name', 'level_type', 'quantity', 'price', 'date'];

    // Table Relation with Order
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
