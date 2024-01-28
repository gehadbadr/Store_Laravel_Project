<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'desc', 'image', 'meta_title', 'meta_keyword', 'meta_desc', 'statue', 'created_at', 'updated_at', 'deleted_at'];

   
    public function products(){
        return $this->hasMany(Product::class, 'category_id','id');
    }
}
