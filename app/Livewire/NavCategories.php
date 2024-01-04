<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;

class NavCategories extends Component
{
    public function render()
    {
        $categories = Category::orderBy('name', 'asc')->limit(5)->get();
        return view('livewire.nav-categories',compact('categories'));
    }
}
