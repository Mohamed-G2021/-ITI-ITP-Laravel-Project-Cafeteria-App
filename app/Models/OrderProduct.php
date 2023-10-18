<?php

namespace App\Models;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    // protected $table = 'order_products';

    protected $fillable = 
    ['id','order_id','product_id', 'quantity'];

    function product(){
        return $this->belongsTo(Product::class);
    }
}
