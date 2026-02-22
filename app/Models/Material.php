<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'lab_id',
        'name',
        'price',
        'is_optional',
    ];

    // رابطه با لابراتوری که این متریال به آن تعلق دارد
    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    // رابطه با order_materials (سفارشی که از این متریال استفاده کرده)
    public function orderMaterials()
    {
        return $this->hasMany(OrderMaterial::class);
    }
}
