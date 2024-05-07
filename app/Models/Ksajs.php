<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ksajs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'open_hours',
        'important_details',
        'longitude',
        'latitude',
        'image',
    ];
}
