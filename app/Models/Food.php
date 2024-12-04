<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;


    protected $fillable = 
    [
        'cateory_id',
        'name',
        'image',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
