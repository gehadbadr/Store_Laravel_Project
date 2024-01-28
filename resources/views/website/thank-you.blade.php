@extends('website.layout.layout')
@section('title','شكرا لك')

@section('body')
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{ url('/ ')}}">الرئيسية</a> <span class="mx-2 mb-0">/</span> <strong
              class="text-black">شكرا لك</strong></div>
        </div>
      </div>
    </div>
    
<div class="py-3 pyt-md-4 mt-5 mb-4">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        @if(session('message'))
        <h5 class ="alert alert-success">{{session('message')}}</h5>
        @endif
        <span class="icon-check_circle display-3 text-primary"></span>
      <h2 class="mb-5">شكرا لك لثقتك في موقعنا ونرجوا ان نكون دائما عن حسن ظنك</h2>
      <a href="{{ url('categories')}}" class="btn btn-primary">تسوق الان</a>
      </div> 
    </div>
  </div>
</div>


@endsection
