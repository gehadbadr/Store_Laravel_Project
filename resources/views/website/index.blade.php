@extends('website.layout.layout')
@section('title','الرئيسية')

@section('body')

<div id="slider" class="carousel slide " data-ride="carousel">

		  <!-- Indicators -->
		  <ul class="carousel-indicators">
		    @for($i=0;$i< $sliders->count();$i++)
		    <li data-target="#slider" data-slide-to="{{ $i }}" {{ $i == '0'?'class="active"':' ' }}></li>
			@endfor
			
		  </ul>

		  <!-- The slideshow -->
		  <div class="carousel-inner">
		  @for($i=0;$i< $sliders->count();$i++)
			@if($i== 0)
			<div class="carousel-item active">
			  <img src="{{ asset('upload/slider/'.$sliders[$i]->image)}}" alt="{{ $sliders[$i]->title }}" width="100%" height="700px">
			</div>
		  @else
		  <div class="carousel-item ">
			  <img src="{{ asset('upload/slider/'.$sliders[$i]->image)}}" alt="{{ $sliders[$i]->title }}" width="100%" height="700px">
			</div>
			@endif
		  @endfor
		  </div>

		  <!-- Left and right controls -->
		  <a class="carousel-control-prev" href="#slider" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		  </a>
		  <a class="carousel-control-next" href="#slider" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		  </a>

		</div><!-- .slider_wrap -->
<div class="-carousel -single px-0">
</div>

<div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="title-section text-center col-12">
            <h2>Pharmacy <strong class="text-primary">الاقسام</strong></h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 block-3 products-wrap">
            <div class="nonloop-block-3 owl-carousel owl-theme trending-product">
              @forelse ($treProducts as $treProduct)
              <div class="text-center item mb-4 item-v2">
                <span class="onsale">New</span>
                @if($treProduct->image)
                <a href="{{ url('collection/'.$treProduct->slug.'/') }}"> <img src="{{ asset('upload/product/'.$treProduct->image)}}" alt="{{ $treProduct->name }}" width="300px" height="400px"></a>
                @else
                <a href="{{ url('collection/'.$treProduct->slug.'/') }}"> <img  src="{{ asset('images/no_image.jpg')}}" alt="{{ $treProduct->name }}" width="300px" height="400px"></a>
                @endif
                <h3 class="text-dark"><a href="{{ url('collection/'.$treProduct->slug.'/') }}">{{ $treProduct->name }}</a></h3>
                @if($treProduct->discount_price)
                   <p class="price">$ {{ $treProduct->discount_price }}</p>
                @else 
                  <p class="price">$ {{ $treProduct->price }}</p>
                @endif 
              </div>
              @empty
              <h3>لا يوجد منتجات حاليا</h3>
              @endforelse	
           

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section bg-image overlay" style="background-image: url('images/hero_bg_2.jpg');">
      <div class="container">
        <div class="row justify-content-center text-center">
         <div class="col-lg-7">
           <h3 class="text-white">Sign up for discount up to 55% OFF</h3>
           <p class="text-white">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam.</p>
           <p class="mb-0"><a href="#" class="btn btn-outline-white">Sign up</a></p>
         </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        
        <div class="row justify-content-between">
          <div class="col-lg-6">
            <div class="title-section">
              <h2>Happy <strong class="text-primary">Customers</strong></h2>
            </div>
            <div class="block-3 products-wrap">
            <div class="-single no-direction -carousel">
        
              <div class="testimony">
                <blockquote>
                  <img src="images/person_1.jpg" alt="Image" class="img-fluid">
                  <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur ducimus. Minus ratione sit quaerat unde.&rdquo;</p>
                </blockquote>

                <p class="author">&mdash; Kelly Holmes</p>
              </div>
        
              <div class="testimony">
                <blockquote>
                  <img src="images/person_2.jpg" alt="Image" class="img-fluid">
                  <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore
                    obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur ducimus. Minus ratione sit quaerat
                    unde.&rdquo;</p>
                </blockquote>
              
                <p class="author">&mdash; Rebecca Morando</p>
              </div>
        
              <div class="testimony">
                <blockquote>
                  <img src="images/person_3.jpg" alt="Image" class="img-fluid">
                  <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore
                    obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur ducimus. Minus ratione sit quaerat
                    unde.&rdquo;</p>
                </blockquote>
              
                <p class="author">&mdash; Lucas Gallone</p>
              </div>
        
              <div class="testimony">
                <blockquote>
                  <img src="images/person_4.jpg" alt="Image" class="img-fluid">
                  <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore
                    obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur ducimus. Minus ratione sit quaerat
                    unde.&rdquo;</p>
                </blockquote>
              
                <p class="author">&mdash; Andrew Neel</p>
              </div>
        
            </div>
          </div>
          </div>
          <div class="col-lg-5">
            <div class="title-section">
              <h2 class="mb-5">Why <strong class="text-primary">Us</strong></h2>
              <div class="step-number d-flex mb-4">
                <span>1</span>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore</p>
              </div>

              <div class="step-number d-flex mb-4">
                <span>2</span>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore</p>
              </div>

              <div class="step-number d-flex mb-4">
                <span>3</span>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis voluptatem consectetur quam tempore</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

	<div class="row ">
	</div>


  

@endsection
@section('script')
<script>

$(document).ready(function(){
  $('.trending-product').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:4
          }
      }
  })
});
</script>
@endsection