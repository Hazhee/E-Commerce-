<x-app-layout>
    <style>
        /**
     * The CSS shown here will not be introduced in the Quickstart guide, but shows
     * how you can use CSS to style your Element's container.
     */
    .StripeElement {
      box-sizing: border-box;
      height: 40px;
      padding: 10px 12px;
      border: 1px solid transparent;
      border-radius: 4px;
      background-color: white;
      box-shadow: 0 1px 3px 0 #e6ebf1;
      -webkit-transition: box-shadow 150ms ease;
      transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
      border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;}
    </style>
    <div>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a> 
                    <span></span> Stripe
                </div>
            </div>
        </div>
        <div class="container mb-80 mt-50">
            <div class="row">
                <div class="col-lg-8 mb-40">
                    <h3 class="heading-2 mb-10">Stripe</h3>
                    
                </div>
            </div> 
            <div class="row">
                <div class="col-lg-6">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Stripe Payment</h4>
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
                            <h4>Stripe Payment</h4>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <form action="{{route('stripe.order')}}" method="POST" id="payment-form">
                                @csrf
                                <div class="form-row">
                                    <label for="card-element">
                                        Credit or debit card
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
                                    
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                        <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert"></div>
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

    <script type="text/javascript">
        // Create a Stripe client.
    var stripe = Stripe('pk_test_51OSOwxD6sbaYdY8eLXjfBylQa92nNmQFiXvU4oErTknsnhEl2xowSLVnD9KATzgxlPsyP1T6qKu3Oab2HPd2ZuxQ00QhIefSRT');
    // Create an instance of Elements.
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };
    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      stripe.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });
    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);
      // Submit the form
      form.submit();
    }
    </script>
</x-app-layout>