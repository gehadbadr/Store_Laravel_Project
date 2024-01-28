<?php

namespace App\Http\Livewire\Frontend\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist; 

class WishlistCount extends Component
{
    protected $listeners = ['wishlistAddedUpdated' => 'checkWishlistCount'];
    public $WishlistCount;
    
    public function checkWishlistCount()
    {
        if (Auth::check()) {
            return $this->WishlistCount = Wishlist::where('user_id',auth()->user()->id)->count();
        }else{
            return $this->WishlistCount = 0;
        }
    }  
    
    public function render()
    {
        $this->WishlistCount = $this->checkWishlistCount();
        return view('livewire.frontend.user.wishlist-count',['WishlistCount'=> $this->WishlistCount ]);
    }
}
