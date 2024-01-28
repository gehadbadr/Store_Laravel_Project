<div>
<div class="site-section bg-light">
      <div class="container">
    
        <div class="row">
            <div>
            <div class="card mt-3">
                <div class="card-header"><h4>السعر</h4></div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low" /> الاعلي الي الاقل
                    </label> 
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high" /> الاقل الي الاعلي
                    </label> 
                </div>
            </div>
            </div>
	      	@forelse ($products as $product)
          <div class="col-sm-6 col-lg-4 text-center item mb-4 item-v2">
            @if($product->qty && $product->qty > 0)
              <label class="stock bg-success">In Stock</label>
            @endif 
            @if($product->image)
             <a href="{{ url('collection/'.$category->slug.'/'.$product->slug.'/') }}"> <img src="{{ asset('upload/product/'.$product->image)}}" alt="{{ $product->name }}" width="300px" height="400px"></a>
            @else
             <a href="{{ url('collection/'.$category->slug.'/'.$product->slug.'/') }}"> <img  src="{{ asset('images/no_image.jpg')}}" alt="{{ $product->name }}" width="300px" height="400px"></a>
            @endif 
            <h3 class="text-dark"><a href="{{ url('collection/'.$category->slug.'/'.$product->slug.'/') }}">{{ $product->name }}</a></h3>
            <div class="product-card-body">
                <h5 class="product-name">
                  <a href="">{{ $product->mini_desc }}</a>
                </h5>
              <div>
                @if($product->discount_price)
                <span class="onsale">Sale</span>
                <span class="selling-price"><del>${{ $product->discount_price }}</del></span>
                <span class="original-price">${{ $product->price }}</span>
                @else
                <span class="selling-price">${{ $product->price }}</span>
                @endif 
              </div>
              <div class="mt-2">
                <a href="" class="btn btn1">Add To Cart</a>
                <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                <a href="" class="btn btn1"> View </a>
              </div>
            </div>
          </div>
          @empty
          <h3>لا يوجد منتجات حاليا</h3>
          @endforelse	
        </div>
      
        <div class="row mt-5">
          <div class="col-md-12 text-center">
		 	@if($products)
				{{ $products->links()}}
			@endif 
          </div>
        </div>
      </div>
    </div><!-- .row products -->
 
</div>
