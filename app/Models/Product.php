<?php

namespace App\Models;

use App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected  $fillable = ['name', 'price', 'image', 'category_id'];

    function order()
    {
        return $this->hasMany(Order::class);
    }


    function category()
    {
        return $this->belongsTO(Category::class);
    }
}
