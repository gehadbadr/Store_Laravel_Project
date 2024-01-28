@extends('dashboard.layout.layout')

@section('body')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3> المنتجات   </h3>
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
                            <li class="breadcrumb-item active"> المنتجات</li>
                            <li class="breadcrumb-item active"> اضافة منتج</li>
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
                            <h5>اضف منتج جديد </h5>
                            <a href="{{ url('dashboard/product')}}" class="btn btn-primary btn-sm float-left">back </a>
                        </div>
                        <div class="card-body">
                            @if($errors->any())
                            <div class="alert alert-warning ">
                                @foreach($errors->all() as $errors)
                                <div>{{ $errors}}</div>
                                @endforeach
                            </div>  
                            @endif                 
                            <div class="digital-add needs-validation">
                                <form action="{{ url('dashboard/product')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">المنتج</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab" aria-controls="desc" aria-selected="false">وصف المنتج</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="price-tab" data-bs-toggle="tab" data-bs-target="#price" type="button" role="tab" aria-controls="price" aria-selected="false">سعر المنتج</button>
                                        </li> 
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">صور المنتج</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color" type="button" role="tab" aria-controls="color" aria-selected="false">الوان المنتج</button>
                                        </li>
                                         <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">SEO </button>
                                        </li>
                                        </ul>
                                        <div class="tab-content border mb-4 p-2 " id="myTabContent">
                                        <div class="tab-pane fade show mt-2 active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    اختار القسم</label>
                                                <select name="category_id" id="validationCustom01" rows="5">
                                                @foreach ($categories as $category )
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    اسم المنتج</label>
                                                <input class="form-control" id="validationCustom01" type="text" name="name" >
                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    slug</label>
                                                <input class="form-control" id="validationCustom01" type="text" name="slug" >
                                            </div>
                                            
                                        </div>
                                        <div class="tab-pane fade mt-2" id="desc" role="tabpanel" aria-labelledby="desc-tab">
                                            <div class="form-group">
                                                <label class="col-form-label">وصف مختصر للمنتج</label>
                                                <textarea rows="5" cols="12" name="mini_desc"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">وصف المنتج</label>
                                                <textarea rows="5" cols="12" name="description"></textarea>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade mt-2" id="price" role="tabpanel" aria-labelledby="price-tab">
                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                الحالة</label><br/>
                                                <input  id="validationCustom01" type="checkbox" name="status" style="width:20px;height:20px">  Checked = غيرمتاح, Unchecked = متاح
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Trending</label><br/>
                                                <input  id="validationCustom01" type="checkbox" name="trending" style="width:20px;height:20px">  Checked = Trending, Unchecked = Not trending>
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    السعر</label>
                                                    <input class="form-control" id="validationCustom01" type="text" name="price" >
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0" ><span></span>
                                                سعر الخصم</label>
                                                <input class="form-control" id="validationCustom01" type="text" name="discount_price" >
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span></span>
                                                الكمية </label>
                                                <input class="form-control" id="validationCustom01" type="text" name="qty" >
                                            </div>

                                            
                                        </div>
                                        <div class="tab-pane fade mt-2" id="image" role="tabpanel" aria-labelledby="image-tab">
                                            <div class="form-group">
                                                <label for="validationCustom05" class="col-form-label pt-0">
                                                    الصورة الرئيسية</label>
                                                <input class="form-control" id="validationCustom05" type="file"  name="mainImage">
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustom05" class="col-form-label pt-0">
                                                   الصور الفرعية</label>
                                                <input class="form-control" id="validationCustom05" type="file" multiple name="image[]">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade mt-2" id="color" role="tabpanel" aria-labelledby="color-tab">
                                            <div class="form-group">
                                                <label for="validationCustom05" class="col-form-label pt-0">الالوان</label>
                                                <div class="row">
                                                @forelse ($colors as $color)
                                                <div class="col-md-3">
                                                    <div class="p-2 border mb-3">
                                                        <input  type="checkbox"  name="color[{{$color->id}}]" value="{{$color->id}}"><lable>   {{$color->color}}</lable>
                                                        <br />  
                                                        الكمية : <input  type="number"  name="qtyColor[{{$color->id}}]" style="width:70px; border :1px solid"/>                                           
                                                    </div>
                                                </div>
                                                @empty
                                                <div class="col-md-12">
                                                    <h3>لا توجد الوان</h3>
                                                </div>
                                                @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade mt-2" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                            <div class="form-group">
                                                <h3>SEO Tags</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Meta Title </label>
                                                <input class="form-control" id="validationCustom01" type="text" name="meta_title" >
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Meta Keyword</label>
                                                <textarea rows="5" cols="12" name="meta_keyword"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Meta Description</label>
                                                <textarea rows="5" cols="12" name="meta_desc"></textarea>
                                            </div>
                                        </div>
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