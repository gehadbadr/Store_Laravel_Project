<?php

namespace App\Http\Livewire\Frontend\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Category;
use Livewire\Component;

class WishlistView extends Component
{
    
    public $product_id;


    public function deleteWishlistProd($product_id)
    {
        $this->product_id = $product_id;
        
    }  
 
    public function destroyWishlistProd()
    {
        Wishlist::where('user_id',auth()->user()->id)->where('product_id',$this->product_id)->delete();
        $this->emit('wishlistAddedUpdated');
        $this->dispatchBrowserEvent('message', [
            'text' => 'تم الغاء المنتج بنجاح',
            'type' => 'success',
            'statue' => 200
        ]); 
        $this->dispatchbrowserEvent('close-modal');
     
    }
    /*
    public function deleteWProd($product_id)
    {
        Wishlist::where('user_id',auth()->user()->id)->where('product_id',$product_id )->delete();
        session()->flash('message','تم الغاء القسم بنجاح');
        $this->dispatchBrowserEvent('message', [
            'text' => 'تم الغاء القسم بنجاح',
            'type' => 'success',
            'statue' => 200
        ]);   
    }
*/
    public function render()
    {
        $wishlists = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.user.wishlist-view',compact('wishlists'));   

    }

}
