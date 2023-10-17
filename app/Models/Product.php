<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function orders()
    {
        return $this->belongsToMany(Order::class,"order_products","product_id","order_id")->withPivot('quantity');
    }

    protected  $fillable = ['name', 'price', 'image', 'category_id'];



    function category()
    {
        return $this->belongsTO(Category::class);
    }
}
