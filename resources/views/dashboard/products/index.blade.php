@extends('dashboard.layout.layout')

@section('body')
<div>

    <div wire:ignore.self class="modal fade" id="deleteModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">المنتجات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyProduct">
                    <div class="modal-body">
                        <h4>هل تريد حذف هذا المنتج ؟</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلق</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
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
                            <h5>المنتجات </h5>
                            <a href="{{ url('dashboard/product/create')}}" class="btn btn-primary btn-sm float-left"> اضف منتج جديد </a>
                        </div>
                        <div class="card-body">
                           <table class="table table-bordered table-striped">
                             <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>المنتج</th>
                                    <th>القسم</th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>الحالة</th>
                                    <th></th>
                                </tr>
                             </thead>
                             <tbody>
                             @forelse  ($products as $product )
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @if($product->category)
                                           {{ $product->category->name }}
                                        @else
                                             No Category 
                                        @endif
                                    </td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->qty }}</td>
                                    <td>{{ $product->status == '0'?'متاح':'غير متاح' }}</td>
                                    <td>
                                    <a href="{{ url('dashboard/product/'.$product->id.'/edit') }}" class="btn btn-success">تعديل</a>
                                    <a href="{{ url('dashboard/product/'.$product->id.'/delete') }}" onclick="return confirm ('هل تريد حذف هذا المنتج')" class="btn btn-primary"  >حذف</a>
                                    </td>
                                </tr>
                                @empty
                                <h3>لا يوجد منتجات حاليا</h3>
                                @endforelse
                             </tbody>
                           </table> 
                           <div>{{ $products->links()}}</div>
                           
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</div>
@push('script')
<script>
    window.addEventListener('close-modal', event =>{
        $('#deleteModel').modal('hide');
    });
</script>

@endpush
@endsection