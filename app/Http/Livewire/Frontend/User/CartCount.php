<?php

namespace App\Http\Livewire\Frontend\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart; 

class CartCount extends Component
{
    protected $listeners = ['cartAddedUpdated' => 'checkCartCount'];
    public $cartCount;
    
    public function checkCartCount()
    {
        if (Auth::check()) {
            return $this->cartCount = Cart::where('user_id',auth()->user()->id)->count();
        }else{
            return $this->cartCount = 0;
        }
    }  
    
    public function render()
    {
        $this->cartCount = $this->checkCartCount();
        return view('livewire.frontend.user.cart-count',['cartCount'=> $this->cartCount ]);  
    }
}
