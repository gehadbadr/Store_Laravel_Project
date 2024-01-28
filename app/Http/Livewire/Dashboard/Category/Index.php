<?php

namespace App\Http\Livewire\Dashboard\Category;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\File;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $category_id;
   
   
    public function render()
    {
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('livewire.dashboard.category.index',['categories'=> $categories]);
    }

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
        
    }  
 
    public function destroyCategory()
    {
        $category = Category::find($this->category_id);
        $path = 'upload/category/'.$category->image;
        if(File::exists($path)){
            File::delete($path); 
        }
        $category->delete();
        session()->flash('message','تم الغاء القسم بنجاح');
        $this->dispatchbrowserEvent('close-modal');
    }

    
}