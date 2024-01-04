<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $data = array();

        $data['shipping_name'] = $request->username;
        $data['shipping_email'] = $request->email;
        $data['shipping_phone'] = $request->phone;
        $data['shipping_address'] = $request->address;
        $data['postal_code'] = $request->postalCode;
        $data['note'] = $request->note;

        $data['divisionID'] = $request->divisionID;
        $data['districtID'] = $request->districtID;
        $data['stateID'] = $request->districtID;

        $cartTotal = Cart::total();

        if ($request->payment_option == 'stripe'){
            return view('livewire.payment.stripe', compact('data', 'cartTotal'));
        }elseif ($request->payment_option == 'online') {
            return view('livewire.payment.card', compact('data', 'cartTotal'));
        }else{
            return view('livewire.payment.cash', compact('data', 'cartTotal'));
        }
    }

    public function stripeOrder(Request $request)
    {
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = Cart::total();
        }


        \Stripe\Stripe::setApiKey('sk_test_51OSOwxD6sbaYdY8em99k8mMKOcXjofxv58WkZNYLG1B2jGyj18UGhvyTP116uHWE8ruAXyrXGTwBln4fQ9kJa0kq00tUtxGws4');
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
        'amount' => $total_amount*100,
        'currency' => 'usd',
        'description' => 'Example charge',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);

        $carts = Cart::content();
        
        $order_id = Order::insertGetId([
            'user_id' => auth()->user()->id,
            // 'vender_id' => auth()->user()->id,
            'ship_district_id' => $request->districtID,
            'ship_division_id' => $request->divisionID,
            'ship_state_id' => $request->stateID,
            'name' => auth()->user()->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->postal_code,
            'note' => $request->note,

            
            'payment_type' => $charge->payment_method,
            'payment_method' => 'Stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'ammount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_number' => 'EOS'.mt_rand(10000000, 99999999),
            'order_date' => now(),
            'status' => 'Pending',
            'created_at' => now(),
        ]);

        //mail
        $invoice = Order::findOrFail($order_id);

        $data = [
            'invoice_number' => $invoice->invoice_number,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
        ];

        

        foreach ($carts as $cart) {
            OrderProduct::create([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vender_id' => $cart->options->vender_id,
                // 'color' => $cart->options->color,
                // 'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
            ]);
        }

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        Cart::destroy();

        return redirect('/');
        
    }

    public function cashOrder(Request $request)
    {
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = Cart::total();
        }
        
        $order_id = Order::insertGetId([
            'user_id' => auth()->user()->id,
            'ship_district_id' => $request->districtID,
            'ship_division_id' => $request->divisionID,
            'ship_state_id' => $request->stateID,
            'name' => auth()->user()->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->postal_code,
            'note' => $request->note,

            'payment_type' => 'Cash on delivery',
            'payment_method' => 'Cash on delivery',
            'currency' => 'USD',
            'ammount' => $total_amount,
            'order_number' => 'ORD'.mt_rand(10000000, 99999999),

            'invoice_number' => 'EOS'.mt_rand(10000000, 99999999),
            'order_date' => now(),
            'status' => 'Pending',
            'created_at' => now(),
        ]);

        $carts = Cart::content();

        foreach ($carts as $cart) {
            OrderProduct::create([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vender_id' => $cart->options->vender_id,
                // 'color' => $cart->options->color,
                // 'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
            ]);
        }

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        Cart::destroy();


        return redirect('/');
    }
}
