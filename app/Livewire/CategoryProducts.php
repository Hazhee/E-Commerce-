<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryProducts extends Component
{
    use WithPagination;

    public Category $category;
    public function render()
    {
        $products = Product::where('status', 1)->where("category_id", $this->category->id)->paginate(12);
        $categories = Category::latest()->limit(6)->get();
        $recently = Product::where('status',1)->latest()->limit(3)->get();
        return view('livewire.category-products', compact('products', 'categories', 'recently'));
    }
}
