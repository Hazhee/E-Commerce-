<?php

use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ShipDistrict::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ShipDivision::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ShipState::class)->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('note')->nullable();
            $table->string('payment_type')->default('cash');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('currency')->default('usd');
            $table->string('ammount')->nullable();
            $table->string('order_number')->unique();
            $table->string('invoice_number')->unique();
            $table->string('order_date')->default(now());
            $table->string('confirmed_date')->nullable();
            $table->string('processing_date')->nullable();
            $table->string('picked_date')->nullable();
            $table->string('shipped_date')->nullable();
            $table->string('delivered_date')->nullable();
            $table->string('cancel_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_reason')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
