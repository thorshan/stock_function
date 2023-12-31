<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['stock_id', 'order_quantity', 'price_option', 'order_date'];

    public function stocks(){
        return $this->belongsTo(Stock::class);
    }
}
