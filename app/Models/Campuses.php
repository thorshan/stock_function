<?php

namespace App\Models;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campuses extends Model
{
    use HasFactory;

    public function stocks(){
        return $this->hasMany(Stock::class);
    }
}
