<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function steps()
    {
        return $this->hasMany(OrderStep::class);
    }

    public function materials()
    {
        return $this->hasMany(OrderMaterial::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
}
