<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geoapify extends Model
{
    use HasFactory;

    protected $table = 'geoapify';

    protected $fillable = [
        'city',
        'name',
        'address_line',
        'category',
    ];
}
