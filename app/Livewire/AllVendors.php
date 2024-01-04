<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllVendors extends Component
{
    use WithPagination;
    public function render()
    {
        $vendors = User::role('Vendor')->where('status', 'Active')->paginate(12);
        return view('livewire.all-vendors', compact('vendors'));
    }
}
