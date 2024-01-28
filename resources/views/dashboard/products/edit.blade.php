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
                            <li class="breadcrumb-item active"> تعديل منتج</li>
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
                        <h5>تعديل {{ $product->name}}  </h5>
                        
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
                                <form action="{{ url('dashboard/product/'.$product->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
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
                                                    <option value="{{ $category->id }}" {{ $category->id ==  $product->category_id ? 'selected': ''}}>{{ $category->name }}</option>
                                                @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    اسم المنتج</label>
                                                <input class="form-control" id="validationCustom01" type="text" name="name" value="{{$product->name}}" >
                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    slug</label>
                                                <input class="form-control" id="validationCustom01" type="text" name="slug" value="{{$product->slug}}" >
                                            </div>
                                            
                                        </div>
                                        <div class="tab-pane fade mt-2" id="desc" role="tabpanel" aria-labelledby="desc-tab">
                                            <div class="form-group">
                                                <label class="col-form-label">وصف مختصر للمنتج</label>
                                                <textarea rows="5" cols="12" name="mini_desc">{{$product->mini_desc}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">وصف المنتج</label>
                                                <textarea rows="5" cols="12" name="description">{{$product->description}}</textarea>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade mt-2" id="price" role="tabpanel" aria-labelledby="price-tab">
                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                الحالة</label><br/>
                                                <input  id="validationCustom01" type="checkbox" name="status"  {{$product->status == '1' ? 'checked':''}}  style="width:20px;height:20px">  Checked = غير متاح, Unchecked = متاح
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Trending</label><br/>
                                                <input  id="validationCustom01" type="checkbox" name="trending" {{$product->trending == '1' ? 'checked':''}}  style="width:20px;height:20px">  Checked = Trending, Unchecked = Not trending
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    السعر</label>
                                                    <input class="form-control" id="validationCustom01" type="text" name="price" value="{{$product->price}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0" ><span></span>
                                                سعر الخصم</label>
                                                <input class="form-control" id="validationCustom01" type="text" name="discount_price" value="{{$product->discount_price}}" >
                                            </div>

                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span></span>
                                                الكمية </label>
                                                <input class="form-control" id="validationCustom01" type="text" name="qty" value="{{$product->qty}}">
                                            </div>

                                            
                                        </div>
                                        <div class="tab-pane fade mt-2" id="image" role="tabpanel" aria-labelledby="image-tab">
                                            <div class="form-group">
                                                <label for="validationCustom05" class="col-form-label pt-0">
                                                    الصورة الرئيسية</label>
                                                <input class="form-control" id="validationCustom05" type="file"  name="mainImage">
                                            </div>
                                            <div class="form-group">
                                                <div class ="row">
                                                    @if ($product->image)
                                                        <div class="col-md-2">
                                                            <img src="{{ asset('upload/product/'.$product->image)}}" class=" border" width="50px" height="50px"/>
                                                        </div>    
                                                    @else
                                                        <div class="col-md-2">
                                                           <img src="{{ asset('images/no_image.jpg')}}" width="50px" height="50px"/>
                                                        </div>    
                                                    @endif
                                                </div>                                              
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustom05" class="col-form-label pt-0">
                                                   الصور الفرعية</label>
                                                <input class="form-control" id="validationCustom05" type="file" multiple name="image[]">
                                            </div> 
                                            <div class="form-group">
                                                <div class ="row">
                                                    @forelse ($product->productImages as $productImages)
                                                        <div class="col-md-2">
                                                            <img src="{{ asset('upload/product/'.$productImages->image)}}" class=" border" width="50px" height="50px"/>
                                                            <a href="{{ url('dashboard/product-image/'.$productImages->id.'/delete')}}"  onclick="return confirm ('هل تريد حذف هذه الصورة')"  class="d-block">حذف</a>
                                                        </div>    
                                                    @empty
                                                        <div class="col-md-2">
                                                           <p>لا يوجد صور فرعية للمنتج </p>                                   
                                                        </div>    
                                                    @endforelse
                                                </div>                                              
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
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>اللون</th>
                                                        <th>الكمية</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 @forelse ($product->productColors as $productColor )
                                                    <tr class = "prod_color_tr">
                                                        <td>{{ $productColor->color->color }}</td>
                                                        <td> 
                                                            <div class="input-group" >   
                                                            <input  type="number"  name="qtyColor[{{$productColor->id}}]" class="productColorQty" value="{{ $productColor->qty }}" style="width:70px; border :1px solid"/>
                                                            <button type="button" value="{{ $productColor->id }}"class="updateProductColorQtyBtn btn btn-success btn-sm p-2" style ="border-radius: 0px">تعديل</button></td>
                                                            </div> 
                                                        <td>
                                                        <button type="button" value="{{ $productColor->id }}" onclick="return confirm ('هل تريد حذف هذا اللون')"  class="deleteProductColorBtn btn btn-primary"  >حذف</button>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                        <div class="col-md-12">
                                                            <h3>لا توجد الوان للمنتج</h3>
                                                        </div>
                                                    @endforelse
                                                </tbody>
                                            </table> 
                                        </div>
                                        <div class="tab-pane fade mt-2" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                                            <div class="form-group">
                                                <h3>SEO Tags</h3>
                                            </div>
                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    Meta Title </label>
                                                <input class="form-control" id="validationCustom01" type="text" name="meta_title" value="{{$product->meta_title}}">
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Meta Keyword</label>
                                                <textarea rows="5" cols="12" name="meta_keyword">{{$product->meta_keyword}}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Meta Description</label>
                                                <textarea rows="5" cols="12" name="meta_desc">{{$product->meta_desc}}</textarea>
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
@section('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click','.updateProductColorQtyBtn',function(){
            var product_id = "{{ $product->id}}" ;
            var product_color_id = $(this).val() ;
            var qty = $(this).closest('.prod_color_tr').find('.productColorQty').val();

            if(qty <= 0){
                alert("برجاء ادخال الكمية ");
                return false;
            }

            var data = {
                'product_id': product_id,
                'product_color_id': product_color_id,
                'qty': qty,
                
            };

            $.ajax({
                type: "POST",
                url: '{{URL::to('dashboard/product_color')}}/'+product_color_id,
                data: data,
                success: function (response) {
                    alert(response.message);
                }
            });
        });

        $(document).on('click','.deleteProductColorBtn',function(){
            var product_color_id = $(this).val() ;
            var thisClick = $(this);
            $.ajax({
                type: "GET",
                url: '{{URL::to('dashboard/product_color/')}}/'+product_color_id+'/delete',
                data: product_color_id,
                success: function (response) {
                    thisClick.closest('.prod_color_tr').remove();
                    alert(response.message);
                }
            });
        });
    });
</script>
@endsection