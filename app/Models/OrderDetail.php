<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductColor;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'product_id', 'product_color_id', 'qty', 'price'];
    protected $table = 'order_details';

    public  function order(){
        return $this->belongsTo(Order::class);
    }

    public  function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public  function productColor(){
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }
}
