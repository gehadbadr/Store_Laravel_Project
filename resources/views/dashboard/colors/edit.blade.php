@extends('dashboard.layout.layout')

@section('body')
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
                            <li class="breadcrumb-item active"> تعديل اللوان</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h5>تعديل {{ $color->color}}  </h5>
                            <a href="{{ url('dashboard/color')}}" class="btn btn-primary btn-sm float-left">back </a>
                        </div>
                        <div class="card-body">
                        <div class="digital-add needs-validation">
                                <form action="{{ url('dashboard/color/'.$color->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                            اللون</label>
                                        <input class="form-control" id="validationCustom01" type="text" name="color" value="{{$color->color}}">
                                        @error('name')<small class="text-danger">{{$message}}</small>@enderror
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                            الحالة</label><br/>
                                        <input  id="validationCustom01" type="checkbox" name="status" {{$color->status == '1' ? 'checked':''}} style="width:20px;height:20px">  Checked = غير متاح, Unchecked = متاح
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">تعديل</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection