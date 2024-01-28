<div>
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form wire:submit.prevent="destroycartProd">
                    <div class="modal-body">
                        <h5>هل تريد حذف هذا المنتج ؟</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"  id="message_send">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">اغلق</button>
                    </div>
      </form> 
  
    </div>
  </div>
</div>
@if (!$cart->isEmpty())
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
            
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">الصورة</th>
                    <th class="product-name">المنتج</th>
                    <th class="product-price">السعر </th>
                    <th class="product-total">السعر بعد الخصم</th>
                    <th class="product-quantity">اللون</th>
                    <th class="product-quantity">الكمية</th>
                    <th class="product-quantity">المجموع</th>
                    <th class="product-remove">حذف</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($cart as $cartItem)
                  <tr>
                    <td class="product-thumbnail">
                    @if($cartItem->product->image)
                    <a href="{{ url('collection/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug.'/') }}"> <img src="{{ asset('upload/product/'.$cartItem->product->image)}}" alt="{{ $cartItem->product->name }}" class="img-fluid"></a>
                    @else
                    <a href="{{ url('collection/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug.'/') }}"> <img  src="{{ asset('images/no_image.jpg')}}" alt="{{ $cartItem->product->name }}" class="img-fluid"></a>
                    @endif 
                    </td>
                    <td class="product-name">
                      <a href="{{ url('collection/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug.'/') }}"><h2 class="h5 text-black">{{ $cartItem->product->name }}</h2> </a>
                    </td>
                    <td>$ {{ $cartItem->product->price }}</td>
                    <td>@if($cartItem->product->discount_price)
                        $ {{ $cartItem->product->discount_price }}
                    @else 
                        <p>بدون خصم </p>
                    @endif
                </td>
                    <td>
                        @if($cartItem->productColor)
                                <lable class="p-2" style="background-color:{{$cartItem->productColor->color->color}}"
                                > {{ $cartItem->productColor->color->color}}</lable>
                                <br>
                        @endif
                    </td>
                    <td>
                      <div class="input-group mb-3" style="max-width: 120px;">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-primary " type="button"
                            wire.laoding.attr="disabled"
                            wire:click="decrementQty({{$cartItem->id}})" >&minus;</button>
                        </div>
                        <input type="text" class="form-control text-center" value="{{$cartItem->qty}}" placeholder=""
                          aria-label="Example text with button addon" aria-describedby="button-addon1" readonly>
                        <div class="input-group-append">
                          <button class="btn btn-outline-primary " type="button"
                            wire.laoding.attr="disabled"
                            wire:click="incrementQty({{$cartItem->id}})">&plus;</button>
                        </div>
                      </div>
                    </td>
                    @if($cartItem->product->discount_price)
                    <td>{{$cartItem->qty * $cartItem->product->discount_price }}</td>
                    @php $total_price += $cartItem->qty * $cartItem->product->discount_price @endphp
                    @else
                    <td>{{$cartItem->qty * $cartItem->product->price }}</td>
                    @php $total_price += $cartItem->qty * $cartItem->product->price @endphp
                    @endif
                    @php $total_priceBdiscount += $cartItem->qty * $cartItem->product->price @endphp

                    <td><button type="button" class="btn btn-primary "
                    wire.laoding.attr="disabled"
                    wire:click="removeCartItem({{$cartItem->id}})" 
                    data-toggle="modal" data-target="#exampleModal">X</button>
                    </td>
                   
                  </tr>
                @endforeach
                </tbody>
              </table>  
            </div>
          </form>
        </div>
 
        <div class="row">
           <div class="col pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">الاجمالي</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black">السعر قبل الخصم</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$ {{$total_priceBdiscount}} </strong>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <span class="text-black"> الخصم</span>
                  </div>
                  <div class="col-md-6 text-right">
                  @php $discount = $total_priceBdiscount - $total_price @endphp

                    <strong class="text-black">$ {{$discount}} </strong>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">السعر بعد الخصم</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$ {{$total_price}}</strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5 ">
                  <button class="btn btn-primary btn-lg btn-block" onclick="window.location='{{ url('checkout/') }}'">تاكيد عملية الشراء</button>
                  </div>
                  <div class="col-md-5  ">
                  <button class="btn btn-primary btn-lg btn-block" onclick="window.location='{{ url('/') }}'">العودة للتسوق</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@else
<h3 class="p-3 d-flex ">لا يوجد منتجات حاليا</h3>
 @endif  
</div>



<!-- Modal -->



@push('script')
<script>
    window.addEventListener('close-modal', event =>{
        $('#exampleModal').modal('hide');
    });
   // document.getElementById("message_send").submit()
</script>
@endpush</div>
