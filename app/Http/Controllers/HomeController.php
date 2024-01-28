<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     //   $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::orderBy('id','DESC')->where('status','0')->where('image', '!=', null)->get();
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
        $treProducts = Product::where('trending','1')->latest()->take(15)->get();
        return view('website.index',compact('sliders','categories','treProducts'));   
    }

    public function categories()
    {
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
        $categoriesPage = Category::orderBy('id','DESC')->where('status','0')->paginate(4);
        return view('website.categories.categories',compact('categoriesPage','categories'));   
    }

    public function pcat(string $category_slug)
    {
        $categories = Category::where('status','0')->orderBy('id','DESC')->get();

        $category = Category::where('slug',$category_slug)->first();
        if($category){
            return view('website.products.pcat',compact('categories','category'));       
        }else{
            return redirect()->back()/*->with('message','عفوا هذا القسم غير موجود') */;
        }
    
    }
    public function product(string $category_slug ,string $product_slug)
    {
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
       /* $product = Product::where('slug',$product_slug)->first();
        
        if($product){
            return view('website.products.product',compact('product','categories'));   
        }else{
            return "redirect()->back()";
        }
       */ $category = Category::where('slug',$category_slug)->first();
        if($category){
            $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
        
            if($product){
                return view('website.products.product',compact('product','category','categories'));   
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }

    public function thankyou()
    {
        $categories = Category::orderBy('id','DESC')->where('status','0')->get();
        return view('website.thank-you',compact('categories'));   
    }

    public function home()
    {
        return view('website.index');

     //   return view('index');

       /* if(auth()->user()){
            return view('home');
        }else{
            return view('500');
        }*/
    }

}