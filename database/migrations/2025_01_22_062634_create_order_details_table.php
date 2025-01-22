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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // FK to orders
            $table->foreignId('food_item_id')->constrained('food_items')->onDelete('cascade'); // FK to food_items
            $table->integer('quantity'); // Quantity of food items in the order
            $table->decimal('price', 8, 2); // Price of food item at the time of order
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};