<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;

use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    

    public function index(){

        return view('dashboard.categories.index');   
    }

    public function create(){

        return view('dashboard.categories.create');   
    }

   public function store(CategoryFormRequest $request)
    {
        $validatedData =$request->validated();

        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->desc = $validatedData['desc'];
       
        if($request->hasFile('image')){
       
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move('upload/category/', $imageName);

            $category->image = $imageName;

        }
       
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_desc = $validatedData['meta_desc'];
        
        $category->status = $request->status == true ?'1':'0';
        $category->save();

        return redirect('/dashboard/category')->with('message','تم اضافة القسم بنجاح') ;
    }

    public function edit(Category $category){

        return view('dashboard.categories.edit',compact('category'));   
    }

    public function update(CategoryFormRequest $request ,$category)
    {
        $validatedData =$request->validated();

        $category = Category::findOrfail($category);
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->desc = $validatedData['desc'];
       
        if($request->hasFile('image') ){
            if($request->image->extension() != NULL){
                $path = 'upload/category/'.$category->image;
                if(File::exists($path)){
                    File::delete($path); 
                }

                $imageName = time().'.'.$request->image->extension();  
                $request->image->move('upload/category/', $imageName);
                
                $category->image = $imageName;

            }else{
                $category->image = $this->noImage;
            }
        }    
       
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_desc = $validatedData['meta_desc'];
       
        $category->status = $request->status == true ?'1':'0';
        $category->update();

        return redirect('/dashboard/category')->with('message','تم تعديل القسم بنجاح') ;
    }

}
