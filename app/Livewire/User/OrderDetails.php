<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\OrderProduct;
use Livewire\Component;

class OrderDetails extends Component
{
    public Order $order;
    public function render()
    {
        $orderitems = OrderProduct::with('product')->where('order_id', $this->order->id)->latest()->get();
        return view('livewire.user.order-details', compact('orderitems'));
    }
}
