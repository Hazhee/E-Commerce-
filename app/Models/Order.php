<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Order extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function customer(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function division(){
        return $this->belongsTo(ShipDivision::class,"ship_division_id");
    }

    public function district(){
        return $this->belongsTo(ShipDistrict::class,"ship_district_id");
    }

    public function state(){
        return $this->belongsTo(ShipState::class,"ship_state_id");
    }
    

    public function products(){
        return $this->hasMany(OrderProduct::class);
        // ->withPivot('color','vender_id','qty', 'size', 'price', 'created_at');
    }

   


}
