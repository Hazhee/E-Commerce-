<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Deals extends Component
{
    public function render()
    {
        $hot_deals = Product::where('status',1)->where('hot_deals',1)->where('discount_price', '!=', NULL)->latest()->limit(3)->get();
        $speacial_offers = Product::where('status',1)->where('special_offer',1)->latest()->limit(3)->get();
        $special_deals = Product::where('status',1)->where('special_deals',1)->latest()->limit(3)->get();
        $recently = Product::where('status',1)->latest()->limit(3)->get();
        return view('livewire.deals',compact('hot_deals','speacial_offers','special_deals','recently'));
    }
}
