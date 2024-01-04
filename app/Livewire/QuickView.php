<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class QuickView extends Component
{

    // public $product;

    // #[On('product-detail')]
    // public function update($selectedProduct)
    // {
    //     // $this->product = Product::find($selectedProduct['id']);
    //     // dd($this->product->name);
    // }
    public function render()
    {
        return view('livewire.quick-view');
    }
}
