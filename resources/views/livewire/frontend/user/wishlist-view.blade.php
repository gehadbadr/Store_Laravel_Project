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
      <form wire:submit.prevent="destroyWishlistProd">
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
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
            @if (!$wishlists->isEmpty())
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">الصورة</th>
                    <th class="product-name">المننتج</th>
                    <th class="product-price">السعر </th>
                    <th class="product-total">السعر بعد الخصم</th>
                    <th class="product-remove">حذف</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($wishlists as $wishlist)

                  <tr>
                    <td class="product-thumbnail">
                    @if($wishlist->product->image)
                    <a href="{{ url('collection/'.$wishlist->product->category->slug.'/'.$wishlist->product->slug.'/') }}"> <img src="{{ asset('upload/product/'.$wishlist->product->image)}}" alt="{{ $wishlist->product->name }}" class="img-fluid"></a>
                    @else
                    <a href="{{ url('collection/'.$wishlist->product->category->slug.'/'.$wishlist->product->slug.'/') }}"> <img  src="{{ asset('images/no_image.jpg')}}" alt="{{ $wishlist->product->name }}" class="img-fluid"></a>
                    @endif 
                    </td>
                    <td class="product-name">
                      <a href="{{ url('collection/'.$wishlist->product->category->slug.'/'.$wishlist->product->slug.'/') }}"><h2 class="h5 text-black">{{ $wishlist->product->name }}</h2> </a>
                    </td>
                    <td>$ {{ $wishlist->product->price }}</td>
                    <td>$ {{ $wishlist->product->discount_price }}</td>
                    <td><button type="button" class="btn btn-primary "  wire:click="deleteWishlistProd({{$wishlist->product->id}})" 
                    data-toggle="modal" data-target="#exampleModal">X</button>
                    </td>
                  </tr>
                @endforeach
                
                </tbody>
              </table>
              @else
                  <h3>لا يوجد منتجات حاليا</h3>
              @endif    
            </div>
          </form>
        </div>
 
       
      </div>
    </div>
</div>
</div>



<!-- Modal -->



@push('script')
<script>
    window.addEventListener('close-modal', event =>{
        $('#exampleModal').modal('hide');
    });
   // document.getElementById("message_send").submit()
</script>
@endpush