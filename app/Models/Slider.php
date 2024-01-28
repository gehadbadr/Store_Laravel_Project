<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    protected $fillable = ['title','desc', 'image','statue', 'created_at', 'updated_at', 'deleted_at'];
  
}
