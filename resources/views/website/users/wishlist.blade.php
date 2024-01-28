@extends('website.layout.layout')
@section('title','المنتجات المفضلة')

@section('body')

<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.html">الرئيسية</a> 
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">المستخدم</strong>
            <span class="mx-2 mb-0">/</span>
            <strong class="text-black">المنتجات المفضلة</strong>
          </div>
        </div>
       </div>
    </div>
    <livewire:frontend.user.wishlist-view/>

    </div>
    @endsection
