<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'unit', 'weight', 'quantity','type', 'company_id', 'car_type'
    ];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
