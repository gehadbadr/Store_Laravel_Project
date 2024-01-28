<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session ;
use App\Http\Livewire\Frontend\User;
use App\Models\Cart;
//use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;


class PaypalController extends Controller
{
 /*   public function payment(Request $request)
    {
      // dd($request->order);
      $provider = new PayPalClient;
      $provider->setApiCredentials(config('paypal'));
      $paypalToken = $provider->getAccessToken();
      $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => url('paypal/success'),
                "cancel_url" => url('paypal/cancel')
            ],
            "purchase_units"=>  [
                [
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $request->order
                ]
                ]
            ]
      ]);
      if (isset($response['id']) && $response['id']!=null) {
        foreach ($response['links'] as $link) {
            if ($link['rel']=== 'approve') {
                return redirect()->away($link['href']);
            }
        }
      }else{
        return redirect('paypal/cancel');
      }
    }
*/
    public function payment(/*$total*/)
    {//dd($order->id);

      $provider = new PayPalClient;
      $provider->setApiCredentials(config('paypal'));
      $paypalToken = $provider->getAccessToken();
      $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => url('paypal/success'),
                "cancel_url" => url('paypal/cancel')
            ],
            "purchase_units"=>  [
                [
                "amount" => [
                    "currency_code" => "USD",
                    "value" => Session::get('total')
                ]
                ]
            ]
      ]);
      if (isset($response['id']) && $response['id']!=null) {
        foreach ($response['links'] as $link) {
            if ($link['rel']=== 'approve') {
                return redirect()->away($link['href']);
            }
        }
      }else{
         return redirect('paypal/cancel');
      }
    }

     public function success(Request $request)
    {
      $provider = new PayPalClient;
      $provider->setApiCredentials(config('paypal'));
      $paypalToken = $provider->getAccessToken();
      $response  = $provider->capturePaymentOrder($request->token);
      if (isset($response['status']) && $response['status'] == 'COMPLETED') {
       // add new order;
            if ( Session::get('postal_code') != null) {
              $address = UserAddress::create([
                  'user_id' => auth()->user()->id,
                  'address' => Session::get('address'),
                  'phone' => Session::get('phone'),
                  'city' => Session::get('city'),
                  'country' => Session::get('country'),
                  'postal_code' => Session::get('postal_code'),
              ]);
          }else{
              $address = UserAddress::where('id', Session::get('selectedaddress'))->first();
          }
          $order = Order::create([
              'user_id' => auth()->user()->id,
              'address_id' => $address->id,
              'tracking_no' => 'store-'.Str::random(10),
              'status' =>  Session::get('status'),
              'phone' =>  Session::get('phone'),
              'payment_mode' =>  Session::get('payment_mode'),
              'payment_id' =>  Session::get('payment_id'),
              'total_price' =>  Session::get('total'),
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
          session()->flash('message','مبروك تمت عملية الشراء بنجاح و سيتم ارسال الطلبية في غضون 3 ايام');
          Cart::where('user_id',auth()->user()->id)->delete();

          return redirect()->to('thank-you'); 
      }else{
          return redirect('paypal/cancel');
      }
  
    }

    public function cancel()
    {
      session()->flash('message','هناك مشكلة لم نتمكن من اتمام طلبك');
      return redirect()->to('thank-you');   
    }
}
