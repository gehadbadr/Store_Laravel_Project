<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'address', 'phone', 'city', 'country', 'postal_code'];
    protected $table = 'user_addresses';
   
    public  function order(){
        return $this->hasMany(Order::class);
    }
    public  function user(){
        return $this->belongsTo(User::class);
    }


}
