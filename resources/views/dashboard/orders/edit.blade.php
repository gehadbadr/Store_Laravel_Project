@extends('dashboard.layout.layout')
@section('title','تفاصيل طلبك ')

@section('body')

    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
            @if (session('message'))
                    <h4 class="alert alert-success">{{ session('message')}}</h4>
                    @endif
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3> الطلبات   </h3>
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
                            <li class="breadcrumb-item active"> الطلبات</li>
                            <li class="breadcrumb-item active"> تعديل الطلبات</li>
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
                            <h5>تعديل الطلب رقم : {{ $order->id}}   <i class="fa fa-shopping-cart text-dark float-end "></i></h5>
                            <a href="{{ url('dashboard/invoice/'.$order->id)}}" target="_blank" class="btn btn-primary btn-sm float-left mx-1">عرض الفاتورة </a>
                            <a href="{{ url('dashboard/invoice/'.$order->id.'/generate')}}"  class="btn btn-warning btn-sm float-left mx-1">تحميل الفاتورة  </a>
                            <a href="{{ url('dashboard/invoice/'.$order->id.'/email')}}" class="btn btn-info btn-sm float-left mx-1">ارسال ايميل بالفاتورة  </a>
                            <a href="{{ url('dashboard/order')}}" class="btn btn-primary btn-sm float-left mx-1">back </a>
                        </div>
                       
                        <div class="py-3 pyt-md-4 mt-5 mb-4">
                        <div class="container ">
                            <div class="row">
                            <div class="col-md-6 ">
                                <h5>تفاصيل الطلب</h5>
                                <hr />
                                <h6>رقم الطلب : {{$order->id}}</h6>
                                <h6>رقم الطلبية : {{$order->tracking_no}}</h6>
                                <h6>تاريخ الطلب : {{$order->created_at->format('d-m-Y h:i A')}}</h6>
                                <h6>طريقة الدفع : {{$order->payment_mode == '0' ? 'الدفع عند الاستلام ':' الدفع عن طريق PAYPAL'}}</h6>
                                <h4 class="border p-2 text-success"> حالة الطلب :<span class="fw-bold"> {{$order->status == '0' ? 'قيد التنفيذ':'تم استلام الطلب ' }}</span></h4>
                                <form action="{{ url('dashboard/order/'.$order->id)}}" method="POST" >
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <select name="status"  rows="5" >
                                            <option value="0">  قيد التنفيذ</option>
                                            <option value="1">تم استلام الطلب</option>
                                            <option value="-1"> الغاء الطلب</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit"> تعديل حالة الطلب</button>
                                    </div>
                                </form>

                            </div> 
                            <div class="col-md-6 ">
                                <h5>تفاصيل العميل</h5>
                                <hr />
                                <h6> اسم العميل : {{$order->user->id}}</h6>
                                <h6> الايميل : {{$order->user->email}}</h6>
                                <h6> موبايل : {{$order->userAddress->phone}}</h6>
                                @if($order->tele)
                                <h6> تليفون : {{$order->userAddress->tele}}</h6>
                                @endif
                                <h6> العنوان : {{$order->userAddress->address}}</h6>
                                <h6>  Pin Code  : {{$order->userAddress->postal_code}}</h6>
                            </div> 
                            <div class="col-md-12 ">
                                <h5> المنتجات</h5>
                                <hr />
                                <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th class="product-name">رقم المنتج</th>
                                            <th class="product-thumbnail">الصورة</th>
                                            <th class="product-name">المنتج</th>
                                            <th class="product-quantity">اللون</th>
                                            <th class="product-price">السعر </th>
                                            <th class="product-quantity">الكمية</th>
                                            <th class="product-quantity">المجموع</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $total = 0 ; @endphp
                                        @foreach($order->orderDetails as $orderItem)
                                        <tr>
                                            <td width="10%"> {{ $orderItem->id }}</td>
                                            <td width="10%" class="product-thumbnail">
                                            @if($orderItem->product->image)
                                            <a href="{{ url('collection/'.$orderItem->product->category->slug.'/'.$orderItem->product->slug.'/') }}"> <img src="{{ asset('upload/product/'.$orderItem->product->image)}}" alt="{{ $orderItem->product->name }}" class="img-fluid" width="50px" height="50px"></a>
                                            @else
                                            <a href="{{ url('collection/'.$orderItem->product->category->slug.'/'.$orderItem->product->slug.'/') }}"> <img  src="{{ asset('images/no_image.jpg')}}" alt="{{ $orderItem->product->name }}" class="img-fluid" width="50px" height="50px"></a>
                                            @endif 
                                            </td>
                                            <td class="product-name ">
                                            <a href="{{ url('collection/'.$orderItem->product->category->slug.'/'.$orderItem->product->slug.'/') }}"><h2 class="h5 text-black">{{ $orderItem->product->name }}</h2> </a>
                                            </td>
                                            <td width="10%">
                                                @if($orderItem->productColor)
                                                        <lable class="p-2" style="background-color:{{$orderItem->productColor->color->color}}"
                                                        > {{ $orderItem->productColor->color->color}}</lable>
                                                        <br>
                                                @endif
                                            </td>
                                            <td width="10%">$ {{ $orderItem->price }}</td>
                                            <td width="10%">{{$orderItem->qty}}</td>
                                            <td width="10%" class="fw-bold">$ {{$orderItem->qty * $orderItem->price }}</td>
                                            @php
                                            $total += $orderItem->qty * $orderItem->price;
                                            @endphp 
                                        
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" class="fw-bold">اجمالي الطلبية</td>
                                            <td colspan="1" class="fw-bold"> $ {{$total}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                    </div> 

                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection