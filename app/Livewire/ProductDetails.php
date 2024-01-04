<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;



class ProductDetails extends Component
{
    public Product $product;

    public $quantity;

    public function mount()
    {
        $this->quantity = 1;
    }


    public function addToCart(Product $product)
    {
      
        if($product->discount_price == NULL){
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => $this->quantity, 'price' => $product->price, 'weight' => 550, 'options' => ['thambnail' => $product->thambnail, 'size' => $product->size, 'color' => $product->color, 'vender_id' => $product->vender_id]]);
        }else{
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => $this->quantity, 'price' => $product->discount_price, 'weight' => 550, 'options' => ['thambnail' => $product->thambnail, 'size' => $product->size, 'color' => $product->color, 'vender_id' => $product->vender_id]]);
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
        $catg_id = $this->product->category_id;
        $products = Product::where('category_id', $catg_id)->where('id', '!=', $this->product->id)->latest()->limit(4)->get();
        $ratingAvg = Review::where('product_id', $this->product->id)->where('status', 1)->avg('rating');
        $ratingCount = Review::where('product_id', $this->product->id)->where('status', 1)->count();

        return view('livewire.product-details', compact('products', 'ratingAvg', 'ratingCount'));
    }
}
