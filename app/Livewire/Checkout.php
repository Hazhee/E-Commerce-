<?php

namespace App\Livewire;

use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Checkout extends Component
{

    public $username;
    public $phone;
    public $email;
    public $address;

    public $divisionID;
    public $districtID;
    public $stateID;
    public $postalCode;
    public $note;
    public $cash;
    public $online;
    public $stripe;

    public $data = array();

    public function mount()
    {
        $this->username = auth()->user()->username;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
        $this->address = auth()->user()->address;
        if(Cart::count()<1){
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'please add to cart',
                position: 'top-right',
                timer: 1500,
            );
            return redirect()->route('myCart');   
        }
    }

    // public function placeOrder()
    // {
    //     $this->data['shipping_name'] = $this->username;
    //     $this->data['shipping_email'] = $this->email;
    //     $this->data['shipping_phone'] = $this->phone;
    //     $this->data['shipping_address'] = $this->address;
    //     $this->data['postal_code'] = $this->postalCode;
    //     $this->data['note'] = $this->note;

    //     $this->data['divisionID'] = $this->divisionID;
    //     $this->data['districtID'] = $this->districtID;
    //     $this->data['stateID'] = $this->stateID;

    //     $cartTotal = Cart::total();
        
    //     if ($this->stripe){
    //         return view('livewire.my-cart');
    //     }elseif ($this->online) {
    //         return redirect()->route('card');
    //     }else{
    //         return redirect()->route('cash');
    //     }
    // }

    public function updatedDivisionID()
    {
        $this->districtID = null;
    }

    
    public function render()
    {
        $divisions = ShipDivision::all(); 
        $districts = ShipDistrict::where('ship_division_id', $this->divisionID)->get(); 
        $states = ShipState::where('ship_division_id', $this->divisionID)->where('ship_district_id', $this->districtID)->get(); 
        $carts = Cart::content();
        $cart_total = Cart::total();
        return view('livewire.checkout', compact('carts', 'cart_total','divisions','districts', 'states'));

    }
}
