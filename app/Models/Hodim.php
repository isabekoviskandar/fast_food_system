<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hodim extends Model
{
    use HasFactory;


    protected $fillable = 
    [
        'user_id',
        'bolim_id',
        'oylik_type',
        'oylik_miqdori',
        'bonus',
        'oylik_time',
        'start_time',
        'end_time',
        'time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bolim()
    {
        return $this->belongsTo(Bolim::class);
    }
}
