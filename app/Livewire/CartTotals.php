<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class CartTotals extends Component
{
    public function removeCoupon()
    {
        Session::forget('coupon');
        $this->dispatch('cart_updated');
    }

    #[On('cart_updated')]
    public function render()
    {
        $cart = Cart::total();
        return view('livewire.cart-totals', compact('cart'));
    }
}
