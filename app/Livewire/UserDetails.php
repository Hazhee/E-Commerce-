<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserDetails extends Component
{   

    use WithFileUploads;
    public $user;

    #[Rule('required|min:3|max:50')]
    public $name;

    #[Rule('required|min:3|max:50')]
    public $username;

    #[Rule('required|email|max:255')]
    public $email;

    #[Rule('required')]
    public $phone;


    #[Rule('nullable|image|max:1024')]
    public $profile_photo_path;

    #[Rule('required|min:3|max:50')]
    public $address;

    public function mount(){
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->address = $this->user->address;
        // $this->profile_photo_path = $this->user->profile_photo_path;
    }

    public function update()
    {   

        $validated = $this->validate();

        if($this->profile_photo_path){
            $validated['profile_photo_path'] = $this->profile_photo_path->store('upload/user_images','public');
        }
    
        $this->user->update($validated);

        // $notification = array(
        //     'message' => 'User Profile updated',
        //     'alert-type' => 'success',
        // );

        $this->dispatch(
            'alert',
            type: 'success',
            title: 'updated',
            position: 'top-right',
            timer: 1500,
        );
        

        // if(file('profile_photo_path')){


        //     // $file = file('profile_photo_path');
        //     // @unlink(public_path('upload/user_images/'. $this->profile_photo_path));
        //     // $filename = date('YmdHi').$file->getClientOriginalName();
        //     // $file->move(public_path('upload/user_images'),$filename);
        //     // $this->profile_photo_path = $filename;
        // }

        // $data->save();



        


    }
    public function render()
    {
        return view('livewire.user-details');
    }
}
