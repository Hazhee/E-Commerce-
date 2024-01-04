<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class CategorySkip extends Component
{
    public function render()
    {
        $category_1 = Category::skip(2)->first();
        $product_1 = Product::where('status',1)->where('category_id',$category_1->id)->latest()->limit(5)->get();

        $category_2 = Category::skip(6)->first();
        $product_2 = Product::where('status',1)->where('category_id',$category_2->id)->latest()->limit(5)->get();

        $category_3 = Category::skip(3)->first();
        $product_3= Product::where('status',1)->where('category_id',$category_3->id)->latest()->limit(5)->get();
        return view('livewire.category-skip',compact('product_1','product_2','product_3','category_1','category_2','category_3'));
    }
}
