<?php

namespace App\Livewire;

use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ApplyCoupon extends Component
{
    #[Rule('required|min:3|max:255')]
    public $coupon;

    
    public function applyCoupon()
    {
        $this->validateOnly('coupon');
        $data = Coupon::where('name', $this->coupon)->where('validity', '>=', now()->format('d/m/y'))->first();
        if($data){
            Session::put('coupon',[
                'name' => $data->name,
                'discount' => $data->discount,
                'discount_amount' => round(Cart::total() * $data->discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $data->discount/100),
            ]);
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Coupon applied successfully',
                position: 'top-right',
                timer: 1500,
            );
            $this->dispatch('cart_updated');
        }else{
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Invalid Coupon',
                position: 'top-right',
                timer: 1500,
            );
        }
    }

    #[On('cart_updated')]
    public function render()
    {
        return view('livewire.apply-coupon');
    }
}
