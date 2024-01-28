<?php

namespace App\Http\Livewire\Frontend\User;

use Livewire\Component;
use App\Models\Cart;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session ;
use App\Http\Controllers\PaypalController;




class CheckoutView extends Component
{
    public $phone , $selectedaddress ,$address , $tele , $city , $country , $postalCode , $status = 0 , $payment_mode , $payment_id= 0 ;
    protected $listeners = ['validationForALL','transactionEmit'=>'paidOnLineOrder'];

    public function validationForALL()
    {
        $this->validate();
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {         
        if ($this->selectedaddress == null) {
            return [
                'phone'=> 'required|string|max:11|min:10' ,
                'address'=> 'required|string|max:500' ,
                'tele'=> 'required|string||max:11|min:7' ,
                'city'=> 'required|string|max:121' ,
                'country'=> 'required|string|max:121' ,
                'postalCode'=> 'required|string|min:5' 
           ];
        } else {
            return [
                'phone'=> 'required|string|max:11|min:10' ,
                'selectedaddress'=> 'required' 
           ];           

        }
        
       
    }

    public function paypalOrder()
    {
        $this->payment_mode ="1";
      /*  $order = $this->placeOrder();
        $order->status = '2';
        $order->update();*/
        
        $this->validate();
        if ($this->selectedaddress == null) {
            Session::put('address', $this->address);
            Session::put('phone', $this->phone);
            Session::put('city', $this->city);
            Session::put('country', $this->country);
            Session::put('postal_code', $this->postalCode);
        }else{
            Session::put('selectedaddress', $this->selectedaddress);
            $address = UserAddress::where('id',$this->selectedaddress)->first();
            Session::put('address_id',$address->id);
        }

        Session::put('user_id', auth()->user()->id);
        Session::put('tracking_no','store-'.Str::random(10));
        Session::put('status', $this->status);
        Session::put('phone', $this->phone);
        Session::put('payment_mode', $this->payment_mode);
        Session::put('payment_id', $this->payment_id);
        Session::put('total_price', $this->total());
        Session::put('shipping_price', '0');
        Session::put('total', $this->total());

        //$total = $this->total();
    return (new PaypalController)->payment();     
    }
    
    public function codOrder()
    {
        $this->payment_mode ="0";
        $codOrder = $this->placeOrder();
        if ($codOrder) {
          //  Cart::where('user_id',auth()->user()->id)->delete();
            session()->flash('message','مبروك تمت عملية الشراء بنجاح و سيتم ارسال الطلبية في غضون 3 ايام');
            $this->dispatchBrowserEvent('message', [
                'text' => 'مبروك تمت عملية الشراء بنجاح و سيتم ارسال الطلبية في غضون 3 ايام',
                'type' => 'success',
                'statue' => 200
            ]); 
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('message', [
                'text' =>'عفوا هناك خطأ حدث برجاء اعادة المحاولة',
                'type' => 'error',
                'statue' => 500
            ]); 
        }     
        
    }

    public function placeOrder()
    {
        $this->validate();
        if ($this->selectedaddress == null) {
            $address = UserAddress::create([
                'user_id' => auth()->user()->id,
                'address' => $this->address,
                'phone' => $this->phone,
                'city' => $this->city,
                'country' => $this->country,
                'postal_code' => $this->postalCode,
            ]);
        }else{
            $address = UserAddress::where('id',$this->selectedaddress)->first();
        }
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'address_id' => $address->id,
            'tracking_no' => 'store-'.Str::random(10),
            'status' => $this->status,
            'phone' => $this->phone,
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
            'total_price' => $this->total(),
            'shipping_price' => '0'
        ]);

        $cart = Cart::where('user_id',auth()->user()->id)->get();
        foreach ($cart as $cartItem) {
            if ($cartItem->product->discount_price) {
                $price = $cartItem->product->discount_price;
            } else {
                $price = $cartItem->product->price;
            }
           $orderDetail = OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'product_color_id' => $cartItem->product_color_id,
            'qty' => $cartItem->qty,
            'price' => $price,
            ]); 

            if ($cartItem->product_color_id != NULL) {
                $cartItem->productColor()->where('id',$cartItem->product_color_id)->decrement('qty',$cartItem->qty);
            } else {
                $cartItem->product()->where('id',$cartItem->product_id)->decrement('qty',$cartItem->qty);
            }

        } 
      return $order;
    }

    public function total()
    {
        $total_price = 0;
        $cart = Cart::where('user_id',auth()->user()->id)->get();
        foreach ($cart as $cartItem) {
            if ($cartItem->product->discount_price) {
                $cartItem->qty * $cartItem->product->discount_price;
                $total_price += $cartItem->qty * $cartItem->product->discount_price;
            } else {
                $cartItem->qty * $cartItem->product->price;
                $total_price += $cartItem->qty * $cartItem->product->price;
            }
        }    
        return $total_price;   
    }


    public function render()
    {
        $total_price = $this->total();
        $user = User::where('id',auth()->user()->id)->get();
        $user_addresses = UserAddress::where('user_id',auth()->user()->id)->get();

        return view('livewire.frontend.user.checkout-view',['total_price'=> $total_price ,'user'=> $user,'user_addresses'=> $user_addresses]);
    }
}
