<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
