<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class HomeVendorList extends Component
{
    public function render()
    {
        $vendors = User::role('Vendor')->where('status', 'Active')->latest()->limit(4)->get();
        return view('livewire.home-vendor-list', compact('vendors'));
    }
}
