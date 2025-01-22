<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Change nullable columns to required since they're required in validation
            $table->string('phone_number')->nullable(false)->change();
            $table->text('address')->nullable(false)->change();
            $table->unsignedBigInteger('RoleID')->nullable(false)->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->unsignedBigInteger('RoleID')->nullable()->change();
        });
    }
};