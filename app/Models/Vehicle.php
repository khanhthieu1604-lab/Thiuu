<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'model',
        'year',
        'rent_price_per_day',
        'sale_price',
        'is_for_rent',  
        'is_for_sale',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(VehicleCategory::class, 'category_id');
    }
}
