<?php

namespace App\Livewire;

use App\Models\Slider;
use Livewire\Component;

class HomeSlider extends Component
{
    public function render()
    {
        $sliders = Slider::orderBy("created_at","desc")->get();
        return view('livewire.home-slider', compact('sliders'));
    }
}
