
<div>
<style>
.carousel-indicators {
    position: absolute;
    right: 0;
    bottom: 10px;
    left: 0;
    z-index: 15;
    display: flex;
    flex-direction: row;
    flex-flow: row wrap;
    justify-content: flex-start;

}
.img-fluid {
    height: 50px;
    width: 50px;
}
</style>

@if (session('message'))
                    <h4 class="alert alert-success">{{ session('message')}}</h4>
                    @endif
<div class="site-section">
    @if ($product)

      <div class="container">
        <div class="row">
          <div class="col-md-5 mr-auto ">
            <div class=" text-center item-v2">
            @if($product->discount_price)
            <span class="onsale">Sale</span>
            @endif
            @if(!$product->image)
            <a  data-lightbox="image-1" href="{{ asset('images/no_image.jpg')}}">
               <img src="{{ asset('images/no_image.jpg')}}"  alt="{{ $product->name }}" height="500px" width="400px">
            </a>
            @else
            
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                  <a data-lightbox="roadtrip" data-slide-to="0" data-target="#myCarousel" href="{{ asset('upload/product/'.$product->image)}}">
                      <img src="{{ asset('upload/product/'.$product->image)}}" alt="{{ $product->name }}" class="img-fluid m-2">
                  </a>
              @if($product->productImages())
                @php $i=0;@endphp
                @foreach ($product->productImages as $productImages)
                @php $i++;@endphp
                  <a data-lightbox="roadtrip" data-slide-to="{{$i}}" data-target="#myCarousel" href="{{ asset('upload/product/'.$productImages->image)}}">
                      <img src="{{ asset('upload/product/'.$productImages->image)}}" alt="{{ $product->name }}" class="img-fluid m-2">
                  </a>

                @endforeach
                @endif
             </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <a  data-lightbox="roadtrip" href="{{ asset('upload/product/'.$product->image)}}">
                    <img src="{{ asset('upload/product/'.$product->image)}}" alt="{{ $product->name }}" height="500px" width="500px">
                  </a>    
                </div>
                @if($product->productImages())
                @php $i=0;@endphp
                @foreach ($product->productImages as $productImages)
                @php $i++;@endphp
                <div class="carousel-item">
                  <a data-lightbox="roadtrip" href="{{ asset('upload/product/'.$productImages->image)}}">
                      <img src="{{ asset('upload/product/'.$productImages->image)}}" alt="{{ $product->name }}" height="500px" width="500px">
                  </a>
                </div>

                @endforeach
                @endif
              
              
              </div>

            </div>
           
           
            @endif 
            </div>

            
          </div>
          <div class="col-md-6 desc">
            <h2 class="text-black">{{ $product->name }}</h2>
            @if($product->qty)
                <lable class="btn-sm py-1 mt-2 text-white bg-success"> In stock</lable>
            @else
                <lable class="btn-sm py-1 mt-2 text-white bg-danger"> Out of stock</lable>
            @endif
            <p>{{ $product->description }}</p>
            
            @if($product->discount_price)
            <p><del>${{ $product->price }}</del>  <strong class="text-primary h4">${{ $product->discount_price }}</strong></p>
            @else
            <p><strong class="text-primary h4">${{ $product->price }}</strong></p>
            @endif 
            @if($product->productColors())
                @foreach ($product->productColors as $productColors)
                    <lable class="p-2" style="background-color:{{ $productColors->color->color}}"
                    wire:click="colorselected({{ $productColors->id}})"
                    > {{ $productColors->color->color}}</lable>
                @endforeach
                <div class="mt-2">
                    @if($this->prodColorSelctedQty == 'outofstock')
                    <lable class="btn-sm py-1 mt-2 text-white bg-danger"> Out of stock</lable>
                    @elseif($this->prodColorSelctedQty > 0)
                    <lable class="btn-sm py-1 mt-2 text-white bg-success"> In stock</lable>
                    @endif 
                </div> 
            @endif
            
            
            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 220px;">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-primary " type="button"
                  wire:click="decrementqty">&minus;</button>
                </div>
                <input type="text" class="form-control text-center" value="1" placeholder=""
                  aria-label="Example text with button addon" aria-describedby="button-addon1"
                  wire:model="qtycount" readonly>
                <div class="input-group-append">
                  <button class="btn btn-outline-primary " type="button"
                  wire:click="incrementqty">&plus;</button>
                </div>
              </div>
    
            </div>
          
           
            <p  >
              <button type="button" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary"
                 wire:click="addToCart({{ $product->id}})">Add To Cart</button>
              <button type="button" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary "
                 wire:click="addToWishlist({{ $product->id}})">
                  <span wire:loading.remove wire:target="addToWishlist">
                  <i class="fa fa-heart"></i> اضف الي مفضلتك
                  </span>
                  <span wire:loading wire:target="addToWishlist">
                  جاري التنفيذ......
                  </span>
              </button>
            </p>
            <div class="mt-5">
              <ul class="nav nav-pills mb-3 custom-pill" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                    aria-controls="pills-home" aria-selected="true">Ordering Information</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                    aria-controls="pills-profile" aria-selected="false">Specifications</a>
                </li>
            
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <table class="table custom-table">
                    <thead>
                      <th>Material</th>
                      <th>Description</th>
                      <th>Packaging</th>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">OTC022401</th>
                        <td>Pain Management: Acetaminophen PM Extra-Strength Caplets, 500 mg, 100/Bottle</td>
                        <td>1 BT</td>
                      </tr>
                      <tr>
                        <th scope="row">OTC022401</th>
                        <td>Pain Management: Acetaminophen PM Extra-Strength Caplets, 500 mg, 100/Bottle</td>
                        <td>144/CS</td>
                      </tr>
                      <tr>
                        <th scope="row">OTC022401</th>
                        <td>Pain Management: Acetaminophen PM Extra-Strength Caplets, 500 mg, 100/Bottle</td>
                        <td>1 EA</td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            
                  <table class="table custom-table">
            
                    <tbody>
                      <tr>
                        <td>HPIS CODE</td>
                        <td class="bg-light">999_200_40_0</td>
                      </tr>
                      <tr>
                        <td>HEALTHCARE PROVIDERS ONLY</td>
                        <td class="bg-light">No</td>
                      </tr>
                      <tr>
                        <td>LATEX FREE</td>
                        <td class="bg-light">Yes, No</td>
                      </tr>
                      <tr>
                        <td>MEDICATION ROUTE</td>
                        <td class="bg-light">Topical</td>
                      </tr>
                    </tbody>
                  </table>
            
                </div>
            
              </div>
            </div>

    
          </div>
        </div>
      </div>@else
لا يوجد@endif
</div>
