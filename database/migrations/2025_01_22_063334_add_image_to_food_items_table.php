<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('food_items', function (Blueprint $table) {
        $table->string('image')->nullable(); // Nullable, in case some items don't have images
    });
}

public function down()
{
    Schema::table('food_items', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
};