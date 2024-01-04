<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> 
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Checkout</h3>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are products in your cart</h6>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <h4 class="mb-30">Billing Details</h4>
                    <form action="{{route('checkout.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <input wire:model.live='username' type="text" required="" name="username" placeholder="User Name *">
                            </div>
                            <div class="form-group col-lg-6">
                                <input wire:model='email' type="email" required="" name="email" placeholder="Email *">
                            </div>
                        </div>
                                
                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select wire:model.live = 'divisionID' name="divisionID" class="form-control">
                                        <option value="">Select a Division...</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input wire:model='phone' required="" type="text" name="phone" placeholder="Phone*">
                            </div>
                        </div>

                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select wire:model.live='districtID' name="districtID" class="form-control">
                                        <option value="">Select a District...</option>
                                        @foreach ($districts as $district)
                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input wire:model='postalCode'  type="text" name="postalCode" placeholder="Post Code *">
                            </div>
                        </div>


                        <div class="row shipping_calculator">
                            <div class="form-group col-lg-6">
                                <div class="custom_select">
                                    <select wire:model='stateID' name="stateID" class="form-control">
                                        <option value="">Select an option...</option>

                                        @foreach ($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <input wire:model='address' required="" type="text" name="address" placeholder="Address *">
                            </div>
                        </div>

                        <div class="form-group mb-30">
                            <textarea wire:model='note' name="note" rows="5" placeholder="Additional information"></textarea>
                        </div>
                    
                </div>
            </div>
            <div class="col-lg-5">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                        <h6 class="text-muted">Subtotal</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>

                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="image product-thumbnail"><img src="{{asset('storage/'.$cart->options->thambnail)}}" alt="#"></td>
                                        <td>
                                            <h6 class="w-160 mb-5"><a href="shop-product-full.html" class="text-heading">{{$cart->name}}</a></h6></span>
                                            <div class="product-rate-cover">

                                            <strong>Color : {{(isset($cart->options->color[0]))? $cart->options->color[0] : '...'}}</strong>
                                            <strong>Size : {{(isset($cart->options->size[0]))? $cart->options->size[0] : '...'}}</strong>
                                                
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">x {{$cart->qty}}</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">${{$cart->total}}</h4>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <table class="table no-border">
                            @if (Session::has('coupon'))
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{$cart_total}}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">{{session()->get('coupon')['name']}} %{{session()->get('coupon')['discount']}}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td scope="col" colspan="2">
                                            <div class="divider-2 mt-10 mb-10"></div>
                                        </td>
                                    </tr>
                                
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Discount Amount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{session()->get('coupon')['discount_amount']}}</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{session()->get('coupon')['total_amount']}}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            @else
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{$cart_total}}</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            @endif
                            
                        </table>
                    </div>
                </div>
                <div class="payment ml-30">
                    <h4 class="mb-30">Payment</h4>
                    <div class="payment_option">
                        <div class="custome-radio">
                            <input wire:model='stripe' class="form-check-input" value="stripe" type="radio" name="payment_option" id="exampleRadios3">
                            <label  class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Stripe</label>
                        </div>
                        <div class="custome-radio">
                            <input wire:model='cash' class="form-check-input" checked='' value="cash" type="radio" name="payment_option" id="exampleRadios4">
                            <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                        </div>
                        <div class="custome-radio">
                            <input wire:model='online' class="form-check-input" value="online" type="radio" name="payment_option" id="exampleRadios5">
                            <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                        </div>
                    </div>
                    <div class="payment-logo d-flex">
                        <img class="mr-15" src="assets/imgs/theme/icons/payment-paypal.svg" alt="">
                        <img class="mr-15" src="assets/imgs/theme/icons/payment-visa.svg" alt="">
                        <img class="mr-15" src="assets/imgs/theme/icons/payment-master.svg" alt="">
                        <img src="assets/imgs/theme/icons/payment-zapper.svg" alt="">
                    </div>
                    <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
