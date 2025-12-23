<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'image_path',
    ];

    // Ảnh thuộc về 1 xe
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
