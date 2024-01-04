<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartDetails extends Component
{


    public function removeFromTheCart($item)
    {
        Cart::remove($item);
        // $this->dispatch(
        //     'alert',
        //     type: 'success',
        //     title: 'removed',
        //     position: 'top-right',
        //     timer: 1500,
        // );
    }

    #[On('cart_updated')]
    public function render()
    {
        $cart_count = Cart::content()->count();
        $cart_content = Cart::content();
        $cart_total = Cart::total();
        return view('livewire.cart-details',compact('cart_count','cart_content','cart_total'));
    }
}
