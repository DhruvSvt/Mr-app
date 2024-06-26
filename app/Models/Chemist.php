<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chemist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phn_no', 'contact_person', 'speciality_id', 'area_id', 'image', 'longitude', 'latitude', 'title', 'addresses'
    ];

    // Cast attributes to array
    protected $casts = [
        'longitude' => 'array',
        'latitude' => 'array',
        'title' => 'array',
        'addresses' => 'array',
        'phn_no' => 'array',
    ];

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
}
