@extends('website.layout.layout')
@section('title','الطلبات')

@section('body')

<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.html">الرئيسية</a> 
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">المستخدم</strong>
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black"> الطلبات</strong>
          </div>
        </div>
       </div>
    </div>
    <div class="py-3 pyt-md-4 mt-5 mb-4">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="shadow bg-white p-3 mb-4">
         <h2 class="mb-4 float-end">الطلبات</h2>
         <hr/>
         <div class="table-responsive">
          <table class="table table-brodered table-striped text-center">
            <thead>
              <tr>
                <th>رقم الطلب</th>
                <th>رقم الطلبية </th>
                <th> طريقة الدفع </th>
                <th>  حالة الطلب </th>
                <th> تاريخ الطلب</th>
                <th> </th>
             </tr>
            </thead>
            <tbody>
            @forelse ($orders as $order )
              <tr>
                <td> {{ $order->id }}</td>
                <td> {{ $order->tracking_no }}</td>
                <td> {{ $order->payment_mode == '0' ? 'الدفع عند الاستلام ':' الدفع اونلاين' }}</td>
                <td> {{ $order->status == '0' ? 'قيد التنفيذ':'تم استلام الطلب ' }}</td>
                <td> {{ $order->created_at->format('d-m-Y h:i A') }}</td>
                <td><a href="{{ url('/order/'.$order->id) }}" class="btn btn-success">عرض</a> </td>
              </tr>
            @empty
              <h3>لا يوجد طلبات حاليا</h3>
            @endforelse  
            </tbody>
          </table>
        </div> 
        <div>{{ $orders->links()}}</div>

        </div>    
      </div> 
    </div>
  </div>
</div>
    </div>
    @endsection
