<?php

namespace App\Livewire;

use App\Models\WishList;
use Livewire\Attributes\On;
use Livewire\Component;

class WishListCount extends Component
{

    #[On('wishlist-count')]
    public function render()
    {
        $wishlist_count = WishList::count();

        return view('livewire.wish-list-count', compact('wishlist_count'));
    }
}
