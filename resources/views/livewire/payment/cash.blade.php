<x-app-layout>
    <div>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> 
                    <span></span> Cash
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h3 class="heading-2 mb-10">Cash Payment</h3>
                    
                </div>
            </div> 
            <div class="row">
                <div class="col-lg-6">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Cash Payment</h4>
                            <h6 class="text-muted">Subtotal</h6>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
                                @if (Session::has('coupon'))
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Subtotal</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-brand text-end">${{$cartTotal}}</h4>
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
                                                <h4 class="text-brand text-end">${{$cartTotal}}</h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif
                                
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Cash Payment</h4>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <form action="{{route('cash.order')}}" method="POST" id="payment-form">
                                @csrf
                                <div class="form-row">
                                    <label for="card-element">
                                        Cash Payment
                                    </label>

                                    <input type="hidden" name="username" value="{{$data['shipping_name']}}">
                                    <input type="hidden" name="email" value="{{$data['shipping_email']}}">
                                    <input type="hidden" name="phone" value="{{$data['shipping_phone']}}">
                                    <input type="hidden" name="address" value="{{$data['shipping_address']}}">
                                    <input type="hidden" name="postal_code" value="{{$data['postal_code']}}">
                                    <input type="hidden" name="note" value="{{$data['note']}}">
                                    <input type="hidden" name="divisionID" value="{{$data['divisionID']}}">
                                    <input type="hidden" name="districtID" value="{{$data['districtID']}}">
                                    <input type="hidden" name="stateID" value="{{$data['stateID']}}">
                                    
                                
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit Payment</button>
                            </form>

                        </div>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
