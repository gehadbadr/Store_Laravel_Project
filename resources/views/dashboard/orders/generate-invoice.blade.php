@extends('dashboard.layout.layout')
@section('title','Invoice #')

@section('body')

<style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
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
                            <h3> الفاتورة   </h3>
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
                            <li class="breadcrumb-item active">  الفاتورة</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2" class=" company-data">
                <span>الفاتورة رقم: #{{$order->id}}</span> <br>
                <span>رقم الطلبية : {{$order->tracking_no}}</span> <br>
                <span>تاريخ الطلب : {{$order->created_at->format('d-m-Y h:i A')}}</span> <br>
                    <span>Pin Code  : {{$order->userAddress->postalCode}}</span> <br>
                    <span> العنوان : {{$order->userAddress->address}}</span> <br>
                </th>
                <th width="50%" colspan="2" class="text-end">
                    <h2 class="text-start">Store Ecommerce</h2>
                </th>
               
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">تفاصيل الطلب</th>
                <th width="50%" colspan="2">تفاصيل العميل</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>رقم الطلب:</td>
                <td>{{$order->id}}</td>

                <td>اسم العميل:</td>
                <td>{{$order->user->name}}</td>
            </tr>
            <tr>
                <td>Tracking Id/No.:</td>
                <td>{{$order->tracking_no}}</td>

                <td>الايميل:</td>
                <td>{{$order->user->email}}</td>
            </tr>
            <tr>
                <td>تاريخ الطلب:</td>
                <td>{{$order->created_at->format('d-m-Y h:i A')}}</td>

                <td>الموبايل:</td>
                <td>موبايل : {{$order->userAddress->phone}}</td>
            </tr>
            <tr>
                <td>طريقة الدفع:</td>
                <td>{{$order->payment_mode == '0' ? 'الدفع عند الاستلام ':' الدفع عن طريق PAYPAL'}}</td>

                <td>العنوان:</td>
                <td>{{$order->userAddress->address}}</td>
            </tr>
            <tr>
                <td>حالة الطلب:</td>
                <td>{{$order->status == '0' ? 'قيد التنفيذ':'تم استلام الطلب ' }}</td>

                <td>Pin code:</td>
                <td>{{$order->userAddress->postal_code}}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    المنتجات في الطلب
                </th>
            </tr>
            <tr class="bg-blue">
                <th>كود</th>
                <th>المنتج</th>
                <th>اللون</th>
                <th>السعر</th>
                <th>الكمية</th>
                <th>المجموع</th>
            </tr>
        </thead>
        <tbody>
        @php $total = 0 ; @endphp
            @foreach($order->orderDetails as $orderItem)
            <tr>
                <td width="10%">{{ $orderItem->id }}</td>
                <td>{{ $orderItem->product->name }}</td>
                <td width="10%">
                    @if($orderItem->productColor)
                     {{ $orderItem->productColor->color->color}}
                    @endif
                </td>
                <td width="10%">$ {{ $orderItem->price }}</td>
                <td width="10%">{{$orderItem->qty}}</td>
                <td width="15%" class="fw-bold">$ {{$orderItem->qty * $orderItem->price }}</td>
            </tr>
            @php
                $total += $orderItem->qty * $orderItem->price;
            @endphp 
            @endforeach
            <tr>
                <td colspan="5" class="total-heading">اجمالي المبلغ - <small>شامل الضريبة </small> :</td>
                <td colspan="1" class="total-heading"> $ {{$total}}</td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        شكرا لثقتك ب Store   </p>

        <!-- Container-fluid Ends-->
    </div>
@endsection