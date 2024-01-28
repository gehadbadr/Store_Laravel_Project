<?php

namespace App\Models;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'product_color_id', 'qty'];
    protected $table = 'carts';

    public  function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public  function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public  function productColor(){
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }
}
