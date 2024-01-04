<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function division(){
        return $this->belongsTo(ShipDivision::class,"ship_division_id");
    }

    public function district(){
        return $this->belongsTo(ShipDistrict::class,"ship_district_id");
    }
}
