<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class BecomeVendor extends Component
{
    public $name;
    public $username;
    public $email;
    public $phone;
    public $password;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|max:255|unique:users',
        'username' => 'required|min:3|max:255|unique:users',
        'phone' => 'required|min:11|numeric',
        'password' => 'required|string',
    ];

    public function updated($username)
    {
        $this->validateOnly($username);
    }

    public function create()
    {
        $this->validate();

        $user= User::create([
            'name'=> $this->name,
            'username'=> $this->username,
            'email'=> $this->email,
            'phone'=> $this->phone,
            'vendor_join'=> now(),
            'password'=> Hash::make($this->password),
        ]);

        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Created',
            position: 'top-end',
            timer: 1500,
        );

        $user->assignRole('Vendor');

        return redirect('/vendor');
    }
    public function render()
    {
        return view('livewire.become-vendor');
    }
}
