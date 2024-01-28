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
                            <li class="breadcrumb-item active"> اضافة لون</li>
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
                            <h5>اضف لون جديد </h5>
                            <a href="{{ url('dashboard/color')}}" class="btn btn-primary btn-sm float-left">back </a>
                        </div>
                        <div class="card-body">
                        <div class="digital-add needs-validation">
                                <form action="{{ url('dashboard/color')}}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                        اللون</label>
                                        <input class="form-control" id="validationCustom01" type="text" name="color" >
                                        @error('color')<small class="text-danger">{{$message}}</small>@enderror
                                    </div>
                            
                                    <div class="form-group">
                                        <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                            الحالة</label><br/>
                                        <input  id="validationCustom01" type="checkbox" name="status" style="width:20px;height:20px">  Checked = غير متاح, Unchecked = متاح
                                    </div>                          

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">حفظ</button>
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