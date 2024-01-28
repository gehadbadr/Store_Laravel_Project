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
                            <h3> الالوان   </h3>
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
                            <li class="breadcrumb-item active"> الالوان</li>
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
                            <h5>الالوان </h5>
                            <a href="{{ url('dashboard/color/create')}}" class="btn btn-primary btn-sm float-left"> اضف لون جديد </a>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered table-striped">
                             <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>اللون</th>
                                    <th>الحالة</th>
                                    <th></th>
                                </tr>
                             </thead>
                             <tbody>
                                @forelse ($colors as $color )
                                <tr>
                                    <td>{{ $color->id }}</td>
                                    <td>{{ $color->color }}</td>
                                    <td>{{ $color->status == '0'?'متاح':'غير متاح' }}</td>
                                    <td>
                                    <a href="{{ url('dashboard/color/'.$color->id.'/edit') }}" class="btn btn-success">تعديل</a>
                                    <a href="{{ url('dashboard/color/'.$color->id.'/delete') }}" onclick="return confirm ('هل تريد حذف هذا اللون')" class="btn btn-primary"  >حذف</a>
                                    </td>
                                </tr>
                                @empty
                                <h3>لا يوجد الوان حاليا</h3>
                                @endforelse
                             </tbody>
                           </table> 
                           <div>{{ $colors->links()}}</div>
                           
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</div>

@endsection