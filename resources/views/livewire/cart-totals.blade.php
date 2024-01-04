<div class="border p-md-4 cart-totals ml-30">
    <div class="table-responsive">
        <table class="table no-border">
            @if (Session::has('coupon'))
                <tbody>
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Subtotal</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">${{$cart}}</h4>
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
                            <h4 class="text-brand text-end">{{session()->get('coupon')['name']}} %{{session()->get('coupon')['discount']}} <button wire:click='removeCoupon' type="button"><i class="fi-rs-trash"></i></button></h4>
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
                            <h6 class="text-muted">Subtotal</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">${{$cart}}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td scope="col" colspan="2">
                            <div class="divider-2 mt-10 mb-10"></div>
                        </td>
                    </tr>
                  
                    <tr>
                        <td class="cart_total_label">
                            <h6 class="text-muted">Total</h6>
                        </td>
                        <td class="cart_total_amount">
                            <h4 class="text-brand text-end">${{$cart}}</h4>
                        </td>
                    </tr>
                </tbody>
            @endif
            
        </table>
    </div>
    <a wire:navigate href="{{route('checkout')}}" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
</div>