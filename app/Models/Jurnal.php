<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;


    protected $fillable = 
    [
        'hodim_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
        'time',
    ];


    public function hodim()
    {
        return $this->belongsTo(Hodim::class , 'hodim_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
