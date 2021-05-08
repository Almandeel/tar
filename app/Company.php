<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'phone', 'address', 'account_id',
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
