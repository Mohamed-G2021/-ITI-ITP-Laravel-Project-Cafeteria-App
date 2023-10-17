<?php

namespace App\Models;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class,"order_products","order_id","product_id")->withPivot('quantity');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
