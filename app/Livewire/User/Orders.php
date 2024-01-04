<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', auth()->user()->id)->latest()->get();
        return view('livewire.user.orders', compact('orders'));
    }
}
