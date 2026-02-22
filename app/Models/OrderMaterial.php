<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaterial extends Model
{
    protected $fillable = [
        'order_item_id',
        'material_id',
        'price',
    ];

    // رابطه با OrderItem
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    // رابطه با Material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
