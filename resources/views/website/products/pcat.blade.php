@extends('website.layout.layout')
@section('title')
{{ $category->meta_title }}
@endsection

@section('meta_keyword')
{{ $category->meta_keyword }}
@endsection

@section('meta_desc')
{{ $category->meta_desc }}
@endsection


@section('body')
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">الرئيسية</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">الاقسام</strong><span class="mx-2 mb-0">/</span> <strong class="text-black">{{ $category->name }}</strong></div>
        </div>
      </div>
    </div>
    
    <div class="py-5">
      
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
            <div id="slider-range" class="border-primary"></div>
            <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
          </div>
          <div class="col-lg-6 text-lg-right">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter</h3>
            <button type="button" class="btn btn-primary btn-md dropdown-toggle px-4" id="dropdownMenuReference"
              data-toggle="dropdown">Reference</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
              <a class="dropdown-item" href="#">Relevance</a>
              <a class="dropdown-item" href="#">Name, A to Z</a>
              <a class="dropdown-item" href="#">Name, Z to A</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Price, low to high</a>
              <a class="dropdown-item" href="#">Price, high to low</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  <livewire:frontend.product.pcat :category="$category"/>

@endsection

