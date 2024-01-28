@extends('website.layout.layout')
@section('title','تفاصيل طلبك ')

@section('body')
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{ url('/ ')}}">الرئيسية</a> <span class="mx-2 mb-0">/</span> <strong
              class="text-black"> الطلبات</strong><span class="mx-2 mb-0">/</span> <strong
              class="text-black">تفاصيل الطلب</strong></div>
        </div>
      </div>
    </div>

    <div class="mb-4 mt-4">
      <div class="container">
        <h4 class="text-primary">
          <p class="d-inline float-end">تفاصيل الطلب  </p> <i class="fa fa-shopping-cart text-dark float-end"></i>
          <a href="{{ url('order/')}}" class="btn btn-danger btn-sm ">رجوع</a>     
        </h4> 
      </div>    
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
        <h6>طريقة الطلب : {{$order->payment_mode == '0' ? 'الدفع عند الاستلام ':' الدفع عن طريق PAYPAL'}}</h6>
        <h6 class="border p-2 text-success"> حالة الدفع :<span class="fw-bold"> {{$order->status == '0' ? 'قيد التنفيذ':'تم استلام الطلب ' }}</span></h6>


      </div> 
     <div class="col-md-6 ">
        <h5>تفاصيل العميل</h5>
        <hr />
        <h6> اسم العميل : {{$order->user->id}}</h6>
        <h6> الايميل : {{$order->user->email}}</h6>
        <h6> موبايل : {{$order->user->phone}}</h6>
        @if($order->tele)
        <h6> تليفون : {{$order->tele}}</h6>
        @endif
        <h6> العنوان : {{$order->address}}</h6>
        <h6>  Pin Code  : {{$order->postalCode}}</h6>
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


@endsection
