<div>
<div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>اتمام عملية الشراء</h4>
            <hr>
            @if($total_price != 0)            
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            اجمالي الفاتورة
                            <span class="float-end">${{$total_price}}</span>
                        </h4>
                        <hr>
                        <small> .المنتجات سوف تصل اليك في غضون ثلاث ايام*</small>
                        <br/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            المعلومات الاساسية
                        </h4>
                        <hr>
                        @foreach($user as $user_info)
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                <label>الاسم</label>
                                    <input type="text" name="fullname" class="form-control" value = "{{$user_info->name }}" readonly />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>الايميل</label>
                                    <input type="email" name="email" class="form-control" value = "{{$user_info->email }}" readonly/>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>الموبايل</label>
                                    <input type="text" wire:model.defer="phone" id="phone" class="form-control"  placeholder="ادخل رقم الموبايل"  />
                                    @error('phone')<small class="text-danger">{{$message}}</small>@enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                @if (!$user_addresses->isEmpty())
                                    <label>اختر العنوان</label>
                                    <select  wire:model.defer="selectedaddress" id="selectedaddress">
                                        <option value="">اختر العنوان</option>
                                       @foreach($user_addresses as $user_address)
                                        <option value="{{$user_address->id}}">{{$user_address->address}}</option>
                                       @endforeach
                                    </select>
                                    @error('selectedaddress')<small class="text-danger">{{$message}}</small>@enderror
                                @else
                                    <label>العنوان</label>
                                    <input type="text" wire:model.defer="address" id="address" class="form-control"  placeholder="ادخل العنوان "  />
                                    @error('address')<small class="text-danger">{{$message}}</small>@enderror
                                    <label>التليفون الارضي</label>
                                    <input type="text" wire:model.defer="tele" id="tele" class="form-control"  placeholder="ادخل رقم التلبفون الارضي"  />
                                    @error('tele')<small class="text-danger">{{$message}}</small>@enderror
                                    <label>المدينة</label>
                                    <input type="text" wire:model.defer="city" id="city" class="form-control"  placeholder="ادخل المدينة"  />
                                    @error('city')<small class="text-danger">{{$message}}</small>@enderror
                                    <label>الدولة</label>
                                    <input type="text" wire:model.defer="country" id="country" class="form-control"  placeholder="ادخل  الدولة"  />
                                    @error('country')<small class="text-danger">{{$message}}</small>@enderror
                                    <label>Postal Code </label>
                                    <input type="text" wire:model.defer="postalCode" id="postalCode"class="form-control"  placeholder="postal cobe"  />
                                    @error('postalCode')<small class="text-danger">{{$message}}</small>@enderror
                                @endif  
                                </div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <label>اختر طريقة الدفع: </label>
                                    <div class="d-md-flex align-items-start">
                                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <button class="nav-link active fw-bold"  wire:loading.attr="disabled" id="cashOnDeliveryTab-tab" data-toggle="pill" data-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                                            <button class="nav-link fw-bold"  wire:loading.attr="disabled" id="onlinePayment-tab" data-toggle="pill" data-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                        </div>
                                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                                            <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                <h6>الدفع عند الاستلام</h6>
                                                <hr/>
                                                <button type="button" wire:loading.attr="disabled"  wire:click="codOrder" class="btn btn-primary">
                                                    <span wire:loading.remove wire:target="codOrder"> اكد طلبك ( الدفع عند الاستلام )</span>
                                                    <span wire:loading wire:target="codOrder"> جاري ارسال طلبك</span>
                                                </button>

                                            </div>
                                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h6>الدفع اونلاين</h6>
                                                <hr/>
                                                <div>
                                                   <button type="button" style="max-width:50%;" wire:click="paypalOrder"></button>
                                                   {{--<button type="button"  wire:loading.attr="disabled" class="btn btn-warning">ادفع الان ( PayPal )</button>--}}

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>

            </div>
            @else
            <div class="card card-body shadow ">
                <h4>لا يوجد منتجات مختارة للشراء</h4>
                <a href="{{ url('categories')}}" class="btn btn-warning">تسوق الان</a>
            </div>
            @endif
        </div>
    
    </div></div>
@push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AdKUDSWGyJzvyj_Gu3nFMlEZdCkE0Co-KIfuF6peCgcrV63qapMYG_cLgSthl6y434wegccdZsx3nEJP&currency=USD"></script>

<script>
      paypal.Buttons({
        onClick()  {
            // Show a validation error if the checkbox is not checked
            if (!document.getElementById('phone').value
                || !document.getElementById('selectedaddress').value
                || !document.getElementById('address').value
                || !document.getElementById('tele').value
                || !document.getElementById('city').value
                || !document.getElementById('country').value
                || !document.getElementById('postalCode').value) 
            {
                Livewire.emit('validationForALL');  
                return false;     
            }else{
                @this.set('phone',document.getElementById('phone').value);
                @this.set('selectedaddress',document.getElementById('selectedaddress').value);
                @this.set('address',document.getElementById('address').value);
                @this.set('tele',document.getElementById('tele').value);
                @this.set('city',document.getElementById('city').value);
                @this.set('country',document.getElementById('country').value);
                @this.set('postalCode',document.getElementById('postalCode').value);
            }
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: charge.amount,
                        currency_code:'USD'
                    }
                }]
            });
        },
        // Finalize the transaction
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log(details);
                if(details.status == "COMPLETED"){
                Livewire.emit('transactionEmit',transaction,id);  
                }
                //alert('Transaction completed by ' + details.payer.name.given_name + '!');
            });
        }
        // Order is created on the server and the order id is returned
       /* createOrder() {
          return fetch("/my-server/create-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            // use the "body" param to optionally pass additional order information
            // like product skus and quantities
            body: JSON.stringify({
              cart: [
                {
                  sku: "5",
                  quantity: '0.1',//"{{$total_price}}",
                },
              ],
            }),
          })
          .then((response) => response.json())
          .then((order) => order.id);
        },
        // Finalize the transaction on the server after payer approval
        onApprove(data) {
          return fetch("/my-server/capture-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              orderID: data.orderID
            })
          })
          .then((response) => response.json())
          .then((orderData) => {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            if(transaction.statue == "COMPLETED"){
                Livewire.emit('transactionEmit',transaction,id);  
            }
            //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  window.location.href = 'thank_you.html';
          });
        }*/
      }).render('#paypal-button-container');
    </script>
@endpush