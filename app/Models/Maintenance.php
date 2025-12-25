<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['vehicle_id', 'type', 'cost', 'description', 'maintenance_date'];

    // Quan hệ ngược: 1 lần bảo trì thuộc về 1 xe
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}