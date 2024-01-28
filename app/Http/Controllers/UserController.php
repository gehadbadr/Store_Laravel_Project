<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Order;

class UserController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id','DESC')->where('status','0')->where('image', '!=', null)->get();
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
        return view('website.index',compact('sliders','categories'));   
    }

    public function wishlist()
    {  
        //categories to header and footer
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
        return view('website.users.wishlist',compact('categories'));     
    }

    public function cart()
    {
        //categories to header and footer
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
        return view('website.users.cart',compact('categories'));     
    }
 
    public function checkout()
    {
        //categories to header and footer
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
        return view('website.users.checkout',compact('categories'));     
    }

    public function order()
    {
        //categories to header and footer
        $orders = Order::orderBy('id','DESC')->where('user_id',auth()->user()->id)->paginate(10);
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
        return view('website.users.order',compact('categories','orders'));     
    }

    public function orderView($order_id)
    {
        //categories to header and footer
        $order = Order::where('id',$order_id)->where('user_id',auth()->user()->id)->first();
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
        if ($order) {
            return view('website.users.order-details',compact('categories','order')); 
        }else {
            return redirect()->back()->with('message','عذرا الطلب غير موجود'); 
        }    
    }
}
