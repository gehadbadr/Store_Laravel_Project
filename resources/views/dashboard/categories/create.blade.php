@extends('dashboard.layout.layout')

@section('body')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3> الاقسام   </h3>
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
                            <li class="breadcrumb-item active"> الاقسام</li>
                            <li class="breadcrumb-item active"> اضافة قسم</li>
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
                            <h5>اضف قسم جديد </h5>
                            <a href="{{ url('dashboard/category')}}" class="btn btn-primary btn-sm float-left">back </a>
                        </div>
                        <div class="card-body">
                        <div class="digital-add needs-validation">
                                <form action="{{ url('dashboard/category')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                        اسم القسم</label>
                                    <input class="form-control" id="validationCustom01" type="text" name="name" >
                                    @error('name')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                
                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                         slug</label>
                                    <input class="form-control" id="validationCustom01" type="text" name="slug" >
                                    @error('slug')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">وصف الموقع</label>
                                    <textarea rows="5" cols="12" name="desc"></textarea>
                                    @error('desc')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="validationCustom05" class="col-form-label pt-0">
                                         الصورة</label>
                                    <input class="form-control" id="validationCustom05" type="file" name="image">
                                </div>
                                
                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                         الحالة</label><br/>
                                    <input  id="validationCustom01" type="checkbox" name="status" style="width:20px;height:20px"> Checked = غير متاح, Unchecked = متاح
                                </div>

                                <div class="form-group">
                                    <h3>SEO Tags</h3>
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                    Meta Title </label>
                                    <input class="form-control" id="validationCustom01" type="text" name="meta_title" >
                                    @error('meta_title')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Meta Keyword</label>
                                    <textarea rows="5" cols="12" name="meta_keyword"></textarea>
                                    @error('meta_keyword')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Meta Description</label>
                                    <textarea rows="5" cols="12" name="meta_desc"></textarea>
                                    @error('meta_desc')<small class="text-danger">{{$message}}</small>@enderror
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