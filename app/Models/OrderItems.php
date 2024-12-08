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
        'ovqat_id',
        'count',
        'total_price',
        'status',
    ];

    
}
