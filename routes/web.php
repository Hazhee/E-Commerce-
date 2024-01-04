<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Livewire\AllVendors;
use App\Livewire\BecomeVendor;
use App\Livewire\CategoryProducts;
use App\Livewire\Checkout;
use App\Livewire\MyCart;
use App\Livewire\Payment\Card;
use App\Livewire\Payment\Cash;
use App\Livewire\Payment\Stripe;
use App\Livewire\ProductDetails;
use App\Livewire\User\OrderDetails;
use App\Livewire\VendorDetails;
use App\Livewire\WishList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Route::get('/product/details/{product}', ProductDetails::class)->name('product.details');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/wishlist', WishList::class)->name('wishlist');
    Route::get('/mycart', MyCart::class)->name('myCart');
    Route::get('/checkout', Checkout::class)->name('checkout');
    // Route::get('/checkout/stripe/{data}', Stripe::class)->name('stripe');
    Route::get('/checkout/card', Card::class)->name('card');
    Route::get('/checkout/cash', Cash::class)->name('cash');

    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/stripe/order', [CheckoutController::class, 'stripeOrder'])->name('stripe.order');
    Route::post('/cash/order', [CheckoutController::class, 'cashOrder'])->name('cash.order');


    Route::get('/user/order/details/{order}', OrderDetails::class)->name('order.details');

});
Route::get('/becomevendor', BecomeVendor::class)->name('become.vendor');
Route::get('/{product}', ProductDetails::class)->name('product.details');


Route::get("vendor/details/{vendor}", [UserController::class, 'vendorDetails'])->name('vendor.details');

Route::get("product/category/{category}", CategoryProducts::class)->name('category.products');

Route::get("/vendor/all", AllVendors::class)->name('vendors.index');


Route::get('/{record}/download', [OrderController::class , 'PDFDownload'])->name('order.pdf.download');


