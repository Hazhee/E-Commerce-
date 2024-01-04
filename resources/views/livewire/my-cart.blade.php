<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a wire:navigate href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">My Cart</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">{{count($carts)}}</span> products in your cart</h6>
                    <h6 class="text-body"><a href="#" class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox start pl-30">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                    <label class="form-check-label" for="exampleCheckbox11"></label>
                                </th>
                                <th scope="col" colspan="2">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col" class="end">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr class="pt-30">
                                    <td class="custome-checkbox pl-30">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="">
                                        <label class="form-check-label" for="exampleCheckbox1"></label>
                                    </td>
                                    <td class="image product-thumbnail pt-40"><img src="{{asset('storage/'.$cart->options->thambnail)}}" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">{{$cart->name}}</a></h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-body">${{$cart->price}} </h4>
                                    </td>
                                    <td class="price" data-title="Price">
                                        @if (isset($cart->options->color[0]))
                                            <h4 class="text-body">{{$cart->options->color[0]}} </h4>
                                        @else
                                            <h4 class="text-body">...</h4>
                                        @endif

                                        
                                    </td>
                                    <td class="price" data-title="Price">
                                        @if (isset($cart->options->size[0]))
                                            <h4 class="text-body">{{$cart->options->size[0]}} </h4>
                                        @else
                                            <h4 class="text-body">...</h4>
                                        @endif
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <div class="detail-qty border radius">
                                                <a wire:loading.attr='disabled' wire:click="decrementQty('{{$cart->rowId}}')" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                <input type="text" name="quantity" class="qty-val" value="{{$cart->qty}}" min="1">
                                                <a wire:loading.attr='disabled' wire:click="incrementQty('{{$cart->rowId}}')" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand">${{$cart->subtotal}} </h4>
                                    </td>
                                    <td class="action text-center" data-title="Remove"><button wire:click="removeFromTheCart('{{$cart->rowId}}')" type="button" class="text-body"><i class="fi-rs-trash"></i></button></td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
               

                <div class="row mt-50">
                   

                    <livewire:apply-coupon />

                    <div class="col-lg-7">
                         <div class="divider-2 mb-30"></div>

                        <livewire:cart-totals />
                    </div>
                </div>
            </div>
             
        </div>
    </div>
</div>
