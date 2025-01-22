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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // FK to users
            $table->boolean('default_address')->default(true); // True if using saved address
            $table->text('custom_address')->nullable(); // Custom address for specific order
            $table->enum('status', ['pending', 'in progress', 'delivered']); // Order status
            $table->decimal('total_price', 10, 2); // Max total price 9,999,999.99
            $table->timestamps(); // created_at and updated_at
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