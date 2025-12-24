<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Nên thêm cái này để seed dữ liệu
use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Quan hệ: Một danh mục có nhiều xe
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'category_id');
    }
}