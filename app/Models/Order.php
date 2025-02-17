<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        "total",
        "address",
        "track_code",
        "user_id"
    ];

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
