<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phn_no', 'speciality_id', 'area_id', 'image', 'longitude', 'latitude', 'title', 'addresses'
    ];

    // Cast attributes to array
    protected $casts = [
        'longitude' => 'array',
        'latitude' => 'array',
        'title' => 'array',
        'addresses' => 'array',
    ];
}
