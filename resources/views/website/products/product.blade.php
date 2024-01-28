@extends('website.layout.layout')
@section('title')
{{ $product->meta_title }}
@endsection

@section('meta_keyword')
{{ $product->meta_keyword }}
@endsection

@section('meta_desc')
{{ $product->meta_desc }}
@endsection

@section('body')

<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.html">الرئيسية</a> 
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">الاقسام</strong>
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">{{ $product->category->name }}</strong>
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">{{ $product->name }}</strong>
          </div>
        </div>
      </div>
    </div>
    <livewire:frontend.product.product :product="$product" category="$category"/>

  {{-- @livewire('frontend.product.product', ['category' => $category,'product' => $product])  --}}  
    </div>

@endsection
