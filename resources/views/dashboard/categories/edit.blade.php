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
                            <li class="breadcrumb-item active"> تعديل قسم</li>
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
                            <h5>تعديل {{ $category->name}}  </h5>
                            <a href="{{ url('dashboard/category')}}" class="btn btn-primary btn-sm float-left">back </a>
                        </div>
                        <div class="card-body">
                        <div class="digital-add needs-validation">
                                <form action="{{ url('dashboard/category/'.$category->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                        اسم القسم</label>
                                    <input class="form-control" id="validationCustom01" type="text" name="name" value="{{$category->name}}">
                                    @error('name')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                
                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                         slug</label>
                                    <input class="form-control" id="validationCustom01" type="text" name="slug" value="{{$category->slug}}">
                                    @error('slug')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">وصف الموقع</label>
                                    <textarea rows="5" cols="12" name="desc">{{$category->desc}}</textarea>
                                    @error('desc')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="validationCustom05" class="col-form-label pt-0"></label>
                                         الصورة</label>
                                    <input class="form-control" id="validationCustom05" type="file" name="image">
                                    @if($category->image)
                                    <img src="{{ asset('upload/category/'.$category->image)}}" width="50px" height="50px"/>
                                    @else
                                    <img src="{{ asset('images/no_image.jpg')}}" width="50px" height="50px"/>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                         الحالة</label><br/>
                                    <input  id="validationCustom01" type="checkbox" name="status" {{ $category->status == '1' ? 'checked':''}} style="width:20px;height:20px"> Checked = غير متاح, Unchecked = متاح
                                </div>

                                <div class="form-group">
                                    <h3>SEO Tags</h3>
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                    Meta Title </label>
                                    <input class="form-control" id="validationCustom01" type="text" name="meta_title" value="{{$category->meta_title}}">
                                    @error('meta_title')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Meta Keyword</label>
                                    <textarea rows="5" cols="12" name="meta_keyword">{{$category->meta_keyword}}</textarea>
                                    @error('meta_keyword')<small class="text-danger">{{$message}}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Meta Description</label>
                                    <textarea rows="5" cols="12" name="meta_desc">{{$category->meta_desc}}</textarea>
                                    @error('meta_desc')<small class="text-danger">{{$message}}</small>@enderror
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