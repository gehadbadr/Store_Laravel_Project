<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::orderBy('id','DESC')->paginate(10);
        return view('dashboard.colors.index',['colors'=> $colors]);
    }

    public function create()
    {
        return view('dashboard.colors.create');   
    }

    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ?'1':'0';

        Color::create($validatedData);
        return redirect('/dashboard/color')->with('message','تم اضافة اللون بنجاح') ;

    }

    public function edit(int $color_id)
    {
        $color = Color::findOrFail($color_id);
        return view('dashboard.colors.edit',compact('color'));   
    }
 
    public function update(ColorFormRequest $request,int $color_id)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = $request->status == true ?'1':'0';

        Color::findOrFail($color_id)->update($validatedData);
        return redirect('/dashboard/color')->with('message','تم تعديل اللون بنجاح') ;  
    }

    public function destroy(int $color_id)
    {
        Color::findOrFail($color_id)->delete();
        return redirect('/dashboard/color')->with('message','تم حذف اللون بنجاح') ;  
    }
}
