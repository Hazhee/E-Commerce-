<?php

namespace App\Livewire;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class MyCart extends Component
{

    public function decrementQty($rowId)    
    {
        $row = Cart::get($rowId); 
        Cart::update($rowId, $row->qty - 1);
        if(Session::has('coupon')){
            $name = Session::get('coupon')['name'];
            $data = Coupon::where('name', $name)->first();
            Session::put('coupon',[
                'name' => $data->name,
                'discount' => $data->discount,
                'discount_amount' => round(Cart::total() * $data->discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $data->discount/100),
            ]);
        }
        $this->dispatch('cart_updated');
    }

    public function incrementQty($rowId)    
    {
        $row = Cart::get($rowId); 
        Cart::update($rowId, $row->qty + 1); 
        if(Session::has('coupon')){
            $name = Session::get('coupon')['name'];
            $data = Coupon::where('name', $name)->first();
            Session::put('coupon',[
                'name' => $data->name,
                'discount' => $data->discount,
                'discount_amount' => round(Cart::total() * $data->discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $data->discount/100),
            ]);
        }
        $this->dispatch('cart_updated');
    }
    public function removeFromTheCart($item)
    {
        Cart::remove($item);
        if(Session::has('coupon')){
            $name = Session::get('coupon')['name'];
            $data = Coupon::where('name', $name)->first();
            Session::put('coupon',[
                'name' => $data->name,
                'discount' => $data->discount,
                'discount_amount' => round(Cart::total() * $data->discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $data->discount/100),
            ]);
        }
        $this->dispatch('cart_updated');
    }
    
    public function render()
    {
        $carts = Cart::content();
        return view('livewire.my-cart', compact('carts'));
    }
}
