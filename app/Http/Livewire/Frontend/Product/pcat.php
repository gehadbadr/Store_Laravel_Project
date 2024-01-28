<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Pcat extends Component
{
    public $category,$priceInput;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['priceInput'=> ['except'=>'', 'as'=>'price']];

    public function mount($category)
    {
        $this->category = $category;
    } 
    public function render()
    {
        $products = Product::where('category_id',$this->category->id)->when($this->priceInput, function($q){
            $q->when($this->priceInput == 'high-to-low', function($q2){$q2->orderBy('price','DESC');})
        ->when($this->priceInput == 'low-to-high', function($q2){$q2->orderBy('price','ASC');});
        })->where('status','0')->paginate(14);
        return view('livewire.frontend.product.pcat',['products'=>$products ,'category'=>$this->category ]);
    }
}
