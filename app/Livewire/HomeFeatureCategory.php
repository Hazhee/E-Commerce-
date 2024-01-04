<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class HomeFeatureCategory extends Component
{
    public function render()
    {
        $categories = Category::orderBy("name","asc")->get();
        
        return view('livewire.home-feature-category',compact('categories'));
    }
}
