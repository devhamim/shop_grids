<?php

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
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('brand_id');
            $table->integer('unit_id');
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->string('model')->nullable();
            $table->integer('stock_amount')->nullable();
            $table->integer('regular_price')->default(0);
            $table->integer('selling_price')->default(0);
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->text('image')->nullable();
            $table->integer('hit_count')->default(0);
            $table->integer('sales_count')->default(0);
            $table->tinyInteger('featured_status')->default(0);
            $table->tinyInteger('status')->default(1);

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
