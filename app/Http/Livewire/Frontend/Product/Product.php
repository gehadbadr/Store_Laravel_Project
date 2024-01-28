<?php

namespace App\Http\Livewire\Frontend\Product;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\Wishlist;
use App\Models\Cart;

class Product extends Component
{
    public $category,$product,$prodColorSelctedQty,$qtycount = 1,$productColorId;

    public function colorselected($productColorId)
    {
        $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        if($productColor){
            $this->prodColorSelctedQty = $productColor->qty;
            if ($this->prodColorSelctedQty == 0) {
                $this->prodColorSelctedQty = 'outofstock';
            }
            $this->productColorId =  $productColorId ;
        }
    }

    public function addToWishlist(int $product_id)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id',auth()->user()->id)->where('product_id',$product_id)->exists()) {
                $this->dispatchBrowserEvent('message', [
                    'text' => ' المنتج مضاف بالفعل الي المنتجات المفضلة',
                    'type' => 'warning',
                    'statue' => 409
                ]);
            }else{
                Wishlist::create(['user_id'=> auth()->user()->id,'product_id'=> $product_id]);
                $this->emit('wishlistAddedUpdated');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'تم اضافة المنتج بنجاح لقائمة المنتجات المفضلة',
                    'type' => 'success',
                    'statue' => 200
                ]);

            }
        }else{
            $this->dispatchBrowserEvent('message', [
                'text' => 'برجاء تسجيل الدخول اولا',
                'type' => 'info',
                'statue' => 401
            ]);
            return false;
        }
    }

    public function addToCart(int $product_id)
    {
        if (Auth::check()) {
            if ($this->product->where('id',$product_id)->where('status','0')->exists()) {
                //check for pcolor qty to add to cart          
                if ( $this->product->productColors()->count() > 0) {
                   if ($this->prodColorSelctedQty != NULL ){
                      $productColor = $this->product->productColors()->where('id',$this->productColorId)->first();
                        if ($productColor->qty > 0) {
                            if (Cart::where('user_id',auth()->user()->id)->where('product_id',$product_id)->where('product_color_id',$this->productColorId)->exists()) {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'المنتج مضاف بالفعل الي سلة التسوق',
                                    'type' => 'warning',
                                    'statue' => 404
                                ]);
                            }else {
                                if ($productColor->qty >= $this->qtycount) {
                                    Cart::create([
                                        'user_id'=> auth()->user()->id,
                                        'product_id'=> $product_id,
                                        'product_color_id'=> $this->productColorId,
                                        'qty'=> $this->qtycount
                                    ]);
                                    $this->emit('cartAddedUpdated');
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'تم اضافة المنتج بنجاح لسلة التسوق',
                                        'type' => 'success',
                                        'statue' => 200
                                    ]);
                                }else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'عفوا المتاح من المنتج '.$productColor->qty.' قطع فقط',
                                        'type' => 'warning',
                                        'statue' => 404
                                    ]);         
                                }
                            }
                        }else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'تم نفاذ الكمية',
                                'type' => 'warning',
                                'statue' => 404
                            ]);         
                        }   
                    }else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'يجب تحديد لون المنتج',
                            'type' => 'warning',
                            'statue' => 404
                        ]);         
                    }
                }else {
                    if ($this->product->qty > 0) {
                        if ($this->product->qty >= $this->qtycount) {
                            if (Cart::where('user_id',auth()->user()->id)->where('product_id',$product_id)->exists()) {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'المنتج مضاف بالفعل الي سلة التسوق',
                                    'type' => 'warning',
                                    'statue' => 404
                                ]);
                            }else {
                                Cart::create([
                                    'user_id'=> auth()->user()->id,
                                    'product_id'=> $product_id,
                                    'qty'=> $this->qtycount
                                ]);
                                $this->emit('cartAddedUpdated');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'تم اضافة المنتج بنجاح لسلة التسوق',
                                    'type' => 'success',
                                    'statue' => 200
                                ]);                           
                            }
                        }else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'عفوا المتاح من المنتج '.$this->product->qty.' قطع فقط',
                                'type' => 'warning',
                                'statue' => 404
                            ]);         
                        }
                    }else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'تم نفاذ الكمية',
                            'type' => 'warning',
                            'statue' => 404
                        ]);         
                    }        
                 }
                   
               /* Wishlist::create(['user_id'=> auth()->user()->id,'product_id'=> $product_id]);
                $this->emit('wishlistAddedUpdated');
              //  session()->flash('message','تم اضافة المنتج بنجاح لقائمة المنتجات المفضلة'); 
                $this->dispatchBrowserEvent('message', [
                    'text' => 'تم اضافة المنتج بنجاح لقائمة المنتجات المفضلة',
                    'type' => 'success',
                    'statue' => 200
                ]); */          
            }else{
                $this->dispatchBrowserEvent('message', [
                    'text' => 'المنتج غير متاح',
                    'type' => 'warning',
                    'statue' => 404
                ]);

            }
        }else{
         //   session()->flash('message','برجاء تسجيل الدخول اولا'); 
            $this->dispatchBrowserEvent('message', [
                'text' => 'برجاء تسجيل الدخول اولا',
                'type' => 'info',
                'statue' => 401
            ]);
            return false;
        }
    }
    
    public function incrementqty()
    {
        if ($this->qtycount < 10) {
            $this->qtycount++;
        }
    }

    public function decrementqty()
    {
        if ($this->qtycount >  1) {
            $this->qtycount--;
        }   
    }

    public function mount($category,$product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
    return view('livewire.frontend.product.product',['product'=>$this->product ,'category'=>$this->category ]);
    }
}
