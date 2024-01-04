<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        return view("user.dashboard",compact("user"));
    }

    public function vendorDetails(User $vendor)
    {
        $products = Product::where('vender_id', $vendor->id)->get();
        return view('vendor.vendor-details',compact('products', 'vendor')); 
    }

    
}
