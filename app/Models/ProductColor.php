<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Color;

class ProductColor extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','color_id','qty'];
    protected $table = 'product_colors';

    public  function product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public  function color(){
        return $this->belongsTo(Color::class, 'color_id','id');
    }

    public function productColorSize(){
        return $this->hasMany(ProductColorSize::class);
    }
}
