<?php

namespace App\Livewire\Payment;

use Livewire\Component;

class Stripe extends Component
{
    public $data;
    public function mount(array $data)
    {
        $this->data = $data;
    }

    // public function stripeOrder()
    // {
    //     \Stripe\Stripe::setApiKey('sk_test_51OSOwxD6sbaYdY8em99k8mMKOcXjofxv58WkZNYLG1B2jGyj18UGhvyTP116uHWE8ruAXyrXGTwBln4fQ9kJa0kq00tUtxGws4');
    //     $token = $_POST['stripeToken'];

    //     $charge = \Stripe\Charge::create([
    //     'amount' => 999*100,
    //     'currency' => 'usd',
    //     'description' => 'Example charge',
    //     'source' => $token,
    //     'metadata' => ['order_id' => '6735'],
    //     ]);

    //     dd($charge);
    // }
    public function render()
    {
        return view('livewire.payment.stripe');
    }
}
