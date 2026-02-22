<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
