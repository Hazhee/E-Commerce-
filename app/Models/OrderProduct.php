<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class OrderProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'order_products';

    protected $casts = [
        // 'size' => 'array',
        // 'color' => 'array',
    ];


    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope('by_user', function (Builder $builder) {
            if(auth()->check()){
                if(auth()->user()->hasRole('Admin')){
                    $builder->latest();
                }elseif(auth()->user()->hasRole('Vendor')){
                    $builder->where('vender_id', auth()->user()->id);
                } 
            }
        });
    }

    
    
}
