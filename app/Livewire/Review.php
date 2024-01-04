<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;

class Review extends Component
{
    public $product;
    public $rating;

    public $comment;

    public function submitReview()
    {
        \App\Models\Review::insert([
            'comment' => $this->comment,
            'rating' => $this->rating,
            'product_id' => $this->product->id,
            'user_id' => auth()->user()->id,
            'vender_id' => $this->product->vender_id,
            'created_at' => now(),
        ]);

        $this->reset('comment', 'rating');
        // $this->dispatch('review-updated');
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Review will be approve by Admin',
            position: 'top-right',
            timer: 1500,
        );
    }


    public function render()
    {
        $reviews = \App\Models\Review::where('product_id', $this->product->id)->where('status', 1)->latest()->limit(5)->get();
        return view('livewire.review', compact('reviews'));
    }
}
