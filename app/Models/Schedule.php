<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $dates = [
        'start_time',
        'end_time' 
    ];
    
    protected $fillable = ['movie_id', 'start_time', 'end_time'];
}
