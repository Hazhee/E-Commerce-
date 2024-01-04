<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;



class WishList extends Component
{

    public function addToCart(Product $product)
    {
  
        if($product->discount_price == NULL){
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'weight' => 550, 'options' => ['thambnail' => $product->thambnail]]);
        }else{
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->discount_price, 'weight' => 550, 'options' => ['thambnail' => $product->thambnail]]);
        }

        $this->dispatch('cart_updated');
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'created',
            position: 'top-right',
            timer: 1500,
        );
    }

    public function removeFromWishList($id)
    {
        \App\Models\WishList::destroy($id);

        $this->dispatch('wishlist-count');
        
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Removed',
            position: 'top-right',
            timer: 1500,
        );
    }
    public function render()
    {
        $wishlist = \App\Models\WishList::with('product')->where('user_id', auth()->user()->id)->latest()->get();
        return view('livewire.wish-list', compact('wishlist'));
    }
}
