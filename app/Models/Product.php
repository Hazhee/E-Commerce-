<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'tags' => 'array',
        'size' => 'array',
        'color' => 'array',
        'sub_category_id' => 'array',
        // 'thambnail' => 'array',
        // 'category_id' => 'array',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function vendor(){
        return $this->belongsTo(User::class, 'vender_id');
    }

    public function multiImages(){
        return $this->hasMany(MultyImg::class,'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }


    protected static function booted(): void
    {
        // if (auth()->check()) {
        //     static::addGlobalScope('user', function (Builder $query) {
        //         $query->where('id', auth()->user()->id);
        //         // or with a `team` relationship defined:
        //         $query->whereBelongsTo(auth()->user()->name);
        //     });
        // }

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
