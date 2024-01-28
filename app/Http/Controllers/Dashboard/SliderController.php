<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\SliderFormRequest;
use Illuminate\Support\Facades\File;


class SliderController extends Controller
{
    public $noImage = 'no_image.jpg';

    public function index()
    {
        $sliders = Slider::orderBy('id','DESC')->paginate(10);
        return view('dashboard.sliders.index',['sliders'=> $sliders]);
    }

    public function create()
    {
        return view('dashboard.sliders.create');   
    }

    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();
        $slider = new Slider;
        $slider->title = $validatedData['title'];
        $slider->desc = $validatedData['desc'];
        $validatedData['status'] = $request->status == true ?'1':'0';

        $slider->status =  $validatedData['status'];

        if($request->hasFile('image')){
          
             $imageName = time().'.'.$request->image->extension();  
             $request->image->move('upload/slider/', $imageName);
             $validatedData['image'] = $imageName;
             $slider->image =  $validatedData['image'];

        }

         $slider->save();

       /*  $validatedData['status'] = $request->status == true ?'1':'0';
        Slider::create([
            'title' => $validatedData['title'],
            'desc' => $validatedData['desc'],
            'status' =>  $validatedData['status'], 
            'image' => $validatedData['image'],
        ]);
*/
        return redirect('/dashboard/slider')->with('message','تم اضافة الشريحة بنجاح') ;

    }

    public function edit(int $slider_id)
    {
        $slider = Slider::findOrFail($slider_id);
        return view('dashboard.sliders.edit',compact('slider'));   
    }

    public function update(SliderFormRequest $request,int $slider_id)
    {
        $validatedData = $request->validated();
        $slider = Slider::findOrFail($slider_id);
        
        if($slider){
            $slider->title = $validatedData['title'];
            $slider->desc = $validatedData['desc'];
            $slider->status = $request->status == true ?'1':'0';
            if($request->hasFile('image') ){
                if($request->image->extension() != null){
                    $path = 'upload/slider/'.$slider->image;
                    if(File::exists($path)){
                        File::delete($path); 
                    }
            
    
                    $imageName = time().'.'.$request->image->extension();  
                    $request->image->move('upload/slider/', $imageName);
                    $slider->image = $imageName;
                    $validatedData['image'] = $imageName;
                    $slider->image =  $validatedData['image'];
                }    
                
            }

            $slider->update();
        }      

        return redirect('/dashboard/slider')->with('message','تم تعديل الشريحة بنجاح') ;  
    }

    public function destroy(int $slider_id)
    {
        $slider = Slider::findOrFail($slider_id);
            $path = 'upload/slider/'.$slider->image;
                if(File::exists($path)){
                    File::delete($path); 
                }
        $slider->delete();
        return redirect()->back()->with('message','تم الغاء الشريحة بنجاح') ;

    }
}
