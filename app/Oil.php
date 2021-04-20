<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oil extends Model
{
    protected $fillable = ['type', 'quantity', 'status', 'address', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
