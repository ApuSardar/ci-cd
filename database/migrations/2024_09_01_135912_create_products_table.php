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
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('main_image')->nullable();
            $table->json('multiple_images')->nullable(); // JSON column for storing multiple image paths
            $table->integer('stock');
            $table->decimal('discount', 5, 2)->default(0);
            $table->integer('minimum_dispatch_quantity')->default(1);
            $table->integer('minimum_order_quantity')->default(1);
            $table->integer('send_at_least')->default(1);
            $table->integer('minimum_shipment_qty')->default(1);
            $table->integer('bulk_order_threshold')->default(1);
            $table->integer('minimum_pack_quantity')->default(1);
            $table->integer('required_stock_for_order')->default(0);
            $table->integer('order_min_quantity')->default(1);
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
