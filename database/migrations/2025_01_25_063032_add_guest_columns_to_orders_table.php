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
    Schema::table('orders', function (Blueprint $table) {
        $table->string('guest_name')->nullable()->after('id'); // Guest's name
        $table->string('guest_email')->nullable()->after('guest_name'); // Guest's email
        $table->string('guest_phone')->nullable()->after('guest_email'); // Guest's phone
        $table->foreignId('user_id')->nullable()->change(); // Make user_id nullable for guest orders
    });
}

public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['guest_name', 'guest_email', 'guest_phone']);
        $table->foreignId('user_id')->nullable(false)->change(); // Revert user_id to non-nullable
    });
}

};
