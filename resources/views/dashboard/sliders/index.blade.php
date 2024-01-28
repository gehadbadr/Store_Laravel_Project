@extends('dashboard.layout.layout')

@section('body')
<div>

   
   <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3> الشرائح   </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i data-feather="home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active"> الشرائح</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row product-adding">
                <div class="col-xl-12">
                    @if (session('message'))
                    <h4 class="alert alert-success">{{ session('message')}}</h4>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h5>الشرائح </h5>
                            <a href="{{ url('dashboard/slider/create')}}" class="btn btn-primary btn-sm float-left"> اضف شريحة جديدة </a>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered table-striped">
                             <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>العنوان</th>
                                    <th>الصورة</th>
                                    <th>الحالة</th>
                                    <th></th>
                                </tr>
                             </thead>
                             <tbody>
                                @forelse ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td> 
                                        @if($slider->image)
                                        <img src="{{ asset('upload/slider/'.$slider->image)}}" alt=" Slider" style=" width:70px; height:70px"/>
                                        @else
                                        <img src="{{ asset('images/no_image.jpg')}}" alt=" Slider" style=" width:70px; height:70px"/>
                                        @endif    
                                    </td>
                                    <td>{{ $slider->status == '0'?'متاح':'غير متاح' }}</td>
                                    <td>
                                    <a href="{{ url('dashboard/slider/'.$slider->id.'/edit') }}" class="btn btn-success">تعديل</a>
                                    <a href="{{ url('dashboard/slider/'.$slider->id.'/delete') }}" onclick="return confirm ('هل تريد حذف هذه الشريحة ؟')" class="btn btn-primary"  >حذف</a>
                                    </td>
                                </tr>
                                @empty
                                <h3>لا يوجد شرائح حاليا</h3>
                                @endforelse
                            
                           </tbody>
                           </table> 
                           <div>{{ $sliders->links()}}</div>
                           
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</div>

@endsection