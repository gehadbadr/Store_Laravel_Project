<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\OrderDetail;



class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'address_id', 'tracking_no', 'phone', 'status_message', 'payment_mode', 'payment_id','total_price','shipping_price'];
    protected $table = 'orders';

    public  function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public  function userAddress(){
        return $this->belongsTo(UserAddress::class, 'address_id','id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
/*
    public function orderDetail(){
        return $this->hasMany(OrderDetail::class);
    }
    */
}
