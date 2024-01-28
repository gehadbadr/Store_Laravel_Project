<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'image'];
    protected $table = 'product_images';

    public  function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
  /*  public  function productColorSize(){
        return $this->belongsTo(ProductColorSize::class);
    }*/
} 
