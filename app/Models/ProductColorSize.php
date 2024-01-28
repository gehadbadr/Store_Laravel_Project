<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColorSize extends Model
{
    use HasFactory;
    protected $fillable = ['product_color_id', 'product_size_id', 'quantity', 'price', 'price_two'];
    protected $table = 'product_color_sizes';

    
    public  function productColor(){
        return $this->belongsTo(ProductColor::class);
    }

    public  function productSize(){
        return $this->belongsTo(ProductSize::class);
    }
/*
    public  function productImage(){
        return $this->hasMany(ProductImage::class);
    }
    public  function orderDetail(){
        return $this->hasMany(OrderDetail::class);
    }
    */
}
