<?php

namespace App\Models;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = 
    ['id','status','amount'];


    public function products()
    {
        return $this->belongsToMany(Product::class,'order_products')->withPivot('quantity');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
