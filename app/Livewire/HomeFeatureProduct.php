<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HomeFeatureProduct extends Component
{
    public function render()
    {
        $products = Product::where('status',1)->where('featured', 1)->latest()->limit(6)->get();
        return view('livewire.home-feature-product', compact('products'));
    }
}
