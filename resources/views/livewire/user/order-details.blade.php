<section class="h-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-10 col-xl-8">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-0">Thanks for your Order, <span style="color: #3BB77E;">{{$order->name}}</span>!</h5>
          </div>
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0" style="color: #3BB77E;">Order Products</p>
              <p class="small text-muted mb-0">Receipt Voucher : <span class="text-danger">{{$order->invoice_number}}</span></p>
            </div>
            @foreach ($orderitems as $item)
                <div class="card shadow-0 border mb-4">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                        <img src="{{asset('storage/'.$item->product->thambnail)}}"
                            class="img-fluid" alt="Phone">
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0">{{$item->product->name}}</p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small">
                            @if (isset($item->color))
                                {{$item->color}}
                            @else 
                                ----
                            @endif
                        </p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small">
                            @if (isset($item->size))
                                {{$item->size}}
                            @else 
                                ----
                            @endif
                        </p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small">Qty: {{$item->qty}}</p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                        <p class="text-muted mb-0 small">${{$item->price}}</p>
                        </div>
                    </div>
                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-2">
                        <p class="text-muted mb-0 small">Track Order</p>
                        </div>
                        <div class="col-md-10">
                        <div class="progress" style="height: 6px; border-radius: 16px;">
                            <div class="progress-bar" role="progressbar"
                            style="width: 65%; border-radius: 16px; background-color: #3BB77E;" aria-valuenow="65"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-around mb-1">
                            <p class="text-muted mt-1 mb-0 small ms-xl-5">{{$order->status}}</p>
                            {{-- <p class="text-muted mt-1 mb-0 small ms-xl-5">Delivered</p> --}}
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            @endforeach
            
            

            <div class="d-flex justify-content-between pt-2">
              <p class="fw-bold mb-0">Order Details</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span> ${{$order->ammount}}</p>
            </div>

            <div class="d-flex justify-content-between pt-2">
              <p class="text-muted mb-0">Invoice Number : <span class="text-danger">{{$order->invoice_number}}</span></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Payment Type</span> {{$order->payment_type}}</p>
            </div>

            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0">Order Date : {{$order->created_at->diffForHumans()}}</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">GST 18%</span> 123</p>
            </div>

            <div class="d-flex justify-content-between mb-5">
              <p class="text-muted mb-0 text-danger">Order Number : <span class="text-danger">{{$order->order_number}}</span></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Delivery Charges</span> Free</p>
            </div>
          </div>
          <div class="card-footer border-0 px-4 py-5"
            style="background-color: #3BB77E; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
              paid: <span class="h2 mb-0 ms-2">${{$order->ammount}}</span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>