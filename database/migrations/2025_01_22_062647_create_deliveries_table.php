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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // FK to orders
            $table->foreignId('delivery_person_id')->constrained('users')->onDelete('cascade'); // FK to users with role "delivery"
            $table->enum('delivery_status', ['assigned', 'out for delivery', 'delivered']); // Delivery status
            $table->timestamp('delivery_time')->nullable(); // Delivery time
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};