<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'longitude',
        'latitude',
        'start_date',
        'end_date',
        'image',
    ];
}
