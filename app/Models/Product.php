<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\OrderDetail;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'slug', 'description','mini_desc','price','discount_price','qty', 'trending', 'status', 'meta_title', 'meta_keyword', 'meta_desc'];
    protected $table = 'products';

    public  function category(){
        return $this->belongsTo(Category::class, 'category_id','id');
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class, 'product_id','id');
    }
    public function productColors(){
        return $this->hasMany(ProductColor::class, 'product_id','id');
    }

    public function productSize(){
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function productColorSize(){
        return $this->hasMany(ProductColorSize::class, 'product_id');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function cart(){
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
