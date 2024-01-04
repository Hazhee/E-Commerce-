<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Brand::class)->constrained()->cascadeOnDelete();
            $table->string('category_id');
            $table->string('sub_category_id');
            $table->foreignId('vender_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->string('qty');
            $table->string('tags')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('price');
            $table->string('discount_price')->nullable();
            $table->text('short_desc');
            $table->text('long_desc');
            $table->string('thambnail');
            $table->boolean('hot_deals')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('special_offer')->nullable();
            $table->boolean('special_deals')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
