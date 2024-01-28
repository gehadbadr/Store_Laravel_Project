<?php

namespace App\Http\Livewire\Frontend\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Category;
use Livewire\Component;

class CartView extends Component 
{
    public $cart_id,$total_price = 0,$total_priceBdiscount = 0;
   
    public function incrementQty($cart_id)
    {
        $cartData = Cart::where('user_id',auth()->user()->id)->where('id',$cart_id)->first();
        if($cartData){
            if ($cartData->productColor()->where('id',$cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first(); 
                if ($productColor->qty > $cartData->qty) {
                    $cartData->increment('qty');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'تم تعديل الكمية بنجاح',
                        'type' => 'success',
                        'statue' => 200
                    ]); 
                    $this->dispatchbrowserEvent('close-modal');          
                
                }else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'عفوا المتاح من المنتج '.$productColor->qty.' قطع فقط',
                        'type' => 'warning',
                        'statue' => 404
                    ]);         
                }
                  
            } else {
                if ($cartData->product->qty > $cartData->qty) {
                    $cartData->increment('qty');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'تم تعديل الكمية بنجاح',
                        'type' => 'success',
                        'statue' => 200
                    ]); 
                    $this->dispatchbrowserEvent('close-modal');          
                
                }else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'عفوا المتاح من المنتج '.$cartData->product->qty.' قطع فقط',
                        'type' => 'warning',
                        'statue' => 404
                    ]);         
                }
            }
            
            
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' =>'عفوا هناك خطأ حدث برجاء اعادة المحاولة',
                'type' => 'error',
                'statue' => 500
            ]); 
            $this->dispatchbrowserEvent('close-modal');

        }


    } 

    public function decrementQty($cart_id)
    {
        $cartData = Cart::where('user_id',auth()->user()->id)->where('id',$cart_id)->first();
        if($cartData){
            if ($cartData->qty > 1) {
                if ($cartData->productColor()->where('id',$cartData->product_color_id)->exists()) {
                    $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first(); 
                        $cartData->decrement('qty');
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'تم تعديل الكمية بنجاح',
                            'type' => 'success',
                            'statue' => 200
                        ]); 
                        $this->dispatchbrowserEvent('close-modal');          
                } else {
                        $cartData->decrement('qty');
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'تم تعديل الكمية بنجاح',
                            'type' => 'success',
                            'statue' => 200
                        ]); 
                        $this->dispatchbrowserEvent('close-modal');          
                }             
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'لا يمكن تقليل الكمية عن ذلك .',
                    'type' => 'error',
                    'statue' => 500
                ]); 
                $this->dispatchbrowserEvent('close-modal');
            }        
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' =>'عفوا هناك خطأ حدث برجاء اعادة المحاولة',
                'type' => 'error',
                'statue' => 500
            ]); 
            $this->dispatchbrowserEvent('close-modal');
        }
    } 

    public function removeCartItem($cart_id)
    {
        $this->cart_id = $cart_id;
    } 

    public function destroycartProd()
    {
        $cartRemoved=Cart::where('user_id',auth()->user()->id)->where('id',$this->cart_id)->delete();
        if ($cartRemoved) {
            $this->emit('cartAddedUpdated');
            $this->dispatchBrowserEvent('message', [
                'text' => 'تم الغاء المنتج بنجاح',
                'type' => 'success',
                'statue' => 200
            ]); 
            $this->dispatchbrowserEvent('close-modal');
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' =>'عفوا هناك خطأ حدث برجاء اعادة المحاولة',
                'type' => 'error',
                'statue' => 500
            ]); 
            $this->dispatchbrowserEvent('close-modal');

        }
       
    }

    public function render()
    {
        $cart = Cart::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.user.cart-view',compact('cart'));
    }
}
