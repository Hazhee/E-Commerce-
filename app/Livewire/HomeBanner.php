<?php

namespace App\Livewire;

use App\Models\Banner;
use Livewire\Component;

class HomeBanner extends Component
{
    public function render()
    {
        $banners = Banner::orderBy("created_at","desc")->get();
        return view('livewire.home-banner',compact('banners'));
    }
}
