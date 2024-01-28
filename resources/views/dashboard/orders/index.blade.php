@extends('dashboard.layout.layout')
@section('title','الطلبات')

@section('body')
<div>

   
   <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
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
                            <h5>الطلبات </h5>
                        </div>
                        <form action="">
                        <div class="row card-body">
                                <div class="col-md-3 ">
                                    <label>اختر التاريخ</label>
                                    <input  type="date" name="date" value="{{ Request::get('date') ?? date('Y-m-d')}}" class="form-control">
                                </div>
                            
                                <div class="col-md-3">
                                    <label>اختر حالة الطلب</label>
                                    <select name="status" class="form-control">
                                        <option value=""> كل الطلبات</option>
                                        <option value="0" {{ Request::get('status') == '0' ?'selected':''}} >  قيد التنفيذ</option>
                                        <option value="1" {{ Request::get('status') == '1' ?'selected':''}}>تم استلام الطلب</option>
                                        <option value="-1" {{ Request::get('status') == '-1' ?'selected':''}}> الغاء الطلب</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <br/>
                                    <button  type="submit" class="btn btn-primary">ابحث</button>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-brodered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>رقم الطلب</th>
                                    <th>رقم الطلبية </th>
                                    <th> اسم العميل </th>
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
                                    <td> {{ $order->user->name }}</td>
                                    <td> {{ $order->payment_mode == '0' ? 'الدفع عند الاستلام ':' الدفع اونلاين' }}</td>
                                    <td> {{ $order->status == '0' ? 'قيد التنفيذ':'تم استلام الطلب ' }}</td>
                                    <td> {{ $order->created_at->format('d-m-Y h:i A') }}</td>
                                    <td><a href="{{ url('dashboard/order/'.$order->id.'/edit') }}" class="btn btn-success">عرض</a> </td>
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
        <!-- Container-fluid Ends-->
    </div>
</div>

@endsection