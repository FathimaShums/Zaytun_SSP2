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
        Schema::create('category_food_item', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // FK to categories
            $table->foreignId('food_item_id')->constrained('food_items')->onDelete('cascade'); // FK to food_items
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_food_items');
    }
};