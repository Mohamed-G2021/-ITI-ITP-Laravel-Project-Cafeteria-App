<?php

namespace App\Models;

use App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    function order(){
        return $this->hasMany(Order::class);
    }
}
