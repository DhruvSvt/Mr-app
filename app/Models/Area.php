<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ([
        'area_name',
        'pincode',
        'city_id',
        'status'
    ]);

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
