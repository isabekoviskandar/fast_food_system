<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'order_id',
        'food_id',
        'count',
        'total_price',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
}
