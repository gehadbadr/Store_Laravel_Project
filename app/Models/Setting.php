<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'desc', 'address', 'phone', 'email', 'logo', 'favicon', 'facebook', 'tiwtter', 'instegram', 'tiktok'];
    protected $table = 'settings';
}
