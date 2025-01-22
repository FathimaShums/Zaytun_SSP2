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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('id');
            $table->text('address')->nullable()->after('phone_number');
            $table->unsignedBigInteger('RoleID')->nullable()->after('address');

            // Adding foreign key constraint to RoleID
            $table->foreign('RoleID')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['RoleID']);
        $table->dropColumn(['phone_number', 'address', 'RoleID']); // R
        });
    }
};
