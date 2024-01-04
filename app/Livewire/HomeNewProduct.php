<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\WishList;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeNewProduct extends Component
{
    // public quantity = 1;
    // public Product $selectedProduct;

    // public function productModal(Product $product)
    // {
    //     $this->selectedProduct = $product;
    //     $this->dispatch('product-detail',$this->selectedProduct );
    // }


    public function addToWishList(Product $product)
    {
        if(Auth::check()){
            $exists = WishList::where('user_id', auth()->user()->id)->where('product_id', $product->id)->first();

            if(!$exists){
                WishList::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product->id,
                ]);

                $this->dispatch('wishlist-count');

                $this->dispatch(
                    'alert',
                    type: 'success',
                    title: 'Product successfully added',
                    position: 'top-right',
                    timer: 1500,
                );

            }else{
                $this->dispatch(
                    'alert',
                    type: 'error',
                    title: 'Product is already in Wishlist',
                    position: 'top-right',
                    timer: 1500,
                );
            }
        }else{
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Please first login',
                position: 'top-right',
                timer: 1500,
            );
        }
    }

    public function addToCart(Product $product)
    {
  
        if($product->discount_price == NULL){
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'weight' => 550, 'options' => ['thambnail' => $product->thambnail, 'size' => $product->size, 'color' => $product->color, 'vender_id' => $product->vender_id]]);
        }else{
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->discount_price, 'weight' => 550, 'options' => ['thambnail' => $product->thambnail, 'size' => $product->size, 'color' => $product->color, 'vender_id' => $product->vender_id]]);
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
    public function render()
    {
        $products = Product::where('status', 1)->latest()->get();
        $categories = Category::latest()->get();
        

        return view('livewire.home-new-product',compact('products','categories'));
    }
}
