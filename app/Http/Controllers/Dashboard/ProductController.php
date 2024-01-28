<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\ProductImage;
use App\Models\ProductColor;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Str;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::orderBy('id','DESC')->paginate(10);
        return view('dashboard.products.index',['products'=> $products]);
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::where('status','0')->get();
        return view('dashboard.products.create',compact('categories','colors'));   
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData =$request->validated();
        $category = Category::findOrfail($validatedData['category_id']);

        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'description' => $validatedData['description'],
            'mini_desc' => $validatedData['mini_desc'],
            'status' => $request->status == true ?'1':'0',
            'trending' => $request->trending == true ?'1':'0',
            'price' => $validatedData['price'],
            'discount_price' => $validatedData['discount_price'],
            'qty' => $validatedData['qty'],
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_desc' => $validatedData['meta_desc'],
        ]);

        if($request->hasFile('mainImage')){
             $mainImageName = time().'.'.$request->mainImage->extension();  
             $request->mainImage->move('upload/product/', $mainImageName);
             $validatedData['mainImage'] = $mainImageName;

             $mainImage = $validatedData['mainImage'];
             $product->image = $mainImage;
             $product->update();
        }
        
       
      //  $product_id = Product::orderBy('created_at', 'desc')->first();//DB::select('select * from products  ORDER BY id desc limit 1');
//return  $product1->id ; */

        if($request->hasFile('image')){
            $images=array();
            $i = 1;
            foreach($request->file('image') as $imageFile){
                $imageName = time().$i++.'.'.$imageFile->getClientOriginalExtension(); 
                  //  return  print_r($imageFile->getClientOriginalExtension()) ; 
                $imageFile->move('upload/product/', $imageName);
                $images[] = $imageName;
            }
            foreach($images as $imagePath){

            $product->productImages()->create([
                'product_id' => $product->id,
                'image' =>  $imagePath,
            ]);
            }
        }

        if($request->color){
          
            foreach($request->color as $key => $color){
               if($request->qtyColor[$key] >= 1){
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' =>  $color,
                        'qty' =>  $request->qtyColor[$key]  ?? 0
                    ]);
                }
            }
        }
        return redirect('/dashboard/product')->with('message','تم اضافة المنتج بنجاح') ; 

    }

    public function edit(int $product_id){
        $categories = Category::all();
        $product = Product::findOrFail($product_id);
        //$productImages = $product->productImages()->where('product_id',$product_id)->first();
        // $productColors = $product->productColors()->where('product_id',$product_id)->first();
        $product_color = $product->productColors()->pluck('color_id')->toArray();
       //$productColors = DB::select('SELECT colors.color,product_colors.* FROM `product_colors`,`colors` WHERE `product_colors`.`color_id`= colors.id && `product_colors`.`product_id`= '.$product_id.'');

       //$colors = DB::select('SELECT * FROM `colors` where product_id <> '.$product_id.' && status = 0 ORDER BY `id` DESC');

         $colors = Color::where('status', '0')->whereNotIn('id', $product_color)->get();

        return view('dashboard.products.edit',compact('product','categories','colors'));   
    } 

    public function update(ProductFormRequest $request ,int $product_id)
    {
        $validatedData =$request->validated();
        $product = Product::findOrFail($product_id);
        //$product = Category::findOrfail($validatedData['category_id'])->products()->where('id',$product_id)->first();
        if($request->hasFile('mainImage') ){
            if($request->mainImage->extension() != null){
                $path = 'upload/product/'.$product->image;
                if(File::exists($path)){
                   File::delete($path);
                }
                $mainImageName = time().'.'.$request->mainImage->extension();  
                $request->mainImage->move('upload/product/', $mainImageName);
                $validatedData['mainImage'] = $mainImageName;
                $mainImage = $mainImageName;
            }  
        }else{
            $mainImage = $product->image;
        }    
        if($product){
        $product->name = $validatedData['name'];
        $product->slug = Str::slug($validatedData['slug']);
        $product->category_id = $validatedData['category_id'];
        $product->description = $validatedData['description'];
        $product->mini_desc = $validatedData['mini_desc'];
        $product->status = $request->status == true ?'1':'0';
        $product->trending = $request->trending == true ?'1':'0';
        $product->price = $validatedData['price'];
        $product->discount_price = $validatedData['discount_price'];
        $product->qty = $validatedData['qty'];
        $product->image = $mainImage;
        $product->meta_title = $validatedData['meta_title'];
        $product->meta_keyword = $validatedData['meta_keyword'];
        $product->meta_desc = $validatedData['meta_desc'];
        $product->update();
     
            if($request->hasFile('image')){
                $images=array();
                $i = 1;
                foreach($request->file('image') as $imageFile){
                    $imageName = time().$i++.'.'.$imageFile->getClientOriginalExtension(); 
                    //  return  print_r($imageFile->getClientOriginalExtension()) ; 
                    $imageFile->move('upload/product/', $imageName);
                    $images[] = $imageName;
                }
                foreach($images as $imagePath){

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' =>  $imagePath,
                    ]);
             
                }
            }

            if($request->color){
          
                foreach($request->color as $key => $color){
                    if($request->qtyColor[$key] >= 1){
                    $product->productColors()->create([
                        'product_id' => $product->id,
                        'color_id' =>  $color,
                        'qty' =>  $request->qtyColor[$key]  ?? 0
                    ]);
                    }
                }
            }
          
            return redirect('/dashboard/product')->with('message','تم تعديل المنتج بنجاح') ;
        }else{
            return redirect('/dashboard/product')->with('message','هذا المنتج غير موجود') ;
        }
    }

    public function destroyImage(int $product_image_id)
    {
        $productImage = ProductImage::findorfail($product_image_id);
        $path = 'upload/product/'.$productImage->image;
        if(File::exists($path)){
            File::delete($path); 
        }
        $productImage->delete();
        session()->flash('message','تم الغاء الصورة بنجاح');
        return redirect()->back()->with('message','تم تعديل المنتج بنجاح') ;

    }

    public function updateProductColorQty(request $request ,int $product_color_id)
    {
        
        $productColor = ProductColor::findorfail($product_color_id);
        /* instead of ****
          $productColor = Product::findorfail($request->product_id)->productColors()->where('id',$product_color_id)->first();
        */
        $productColor->qty = $request->qty;
       
        $productColor->update();
        return response()->json(['message'=> 'تم تعديل الكمية بنجاح']);
    }

    public function destroyProductColor(int $product_color_id)
    {
        $productColor = ProductColor::findorfail($product_color_id);
        /* instead of ****
          $productColor = Product::findorfail($request->product_id)->productColors()->where('id',$product_color_id)->first();
        */
       
        $productColor->delete();
        return response()->json(['message'=> 'تم حذف لون المنتج بنجاح']);
    }

    public function destroy(int $product_id)
    {
        $product = Product::findOrFail($product_id);
        if($product->productImages){
            foreach($product->productImages as $image){
            $path = 'upload/product/'.$image->image;
                if(File::exists($path)){
                    File::delete($path); 
                }
          //  $image->delete();
            }
        }
        $product->delete();
        return redirect()->back()->with('message','تم الغاء المنتج بنجاح') ;

    }

}
