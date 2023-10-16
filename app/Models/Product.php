<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  
    protected  $fillable = ['name', 'price', 'image','category_id'];
    use HasFactory;
    function category(){
        return $this->belongsTO(Category::class);
    }
}
