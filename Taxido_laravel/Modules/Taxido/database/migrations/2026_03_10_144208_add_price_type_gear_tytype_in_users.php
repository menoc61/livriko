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
            $table->json('price_type')->nullable()->after('experience');
            $table->string('gear_type')->nullable()->after('price_type');
            $table->integer('experience')->nullable()->change();
            $table->bigInteger('vehicle_type_id')->unsigned()->nullable()->after('gear_type');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->onDelete('cascade')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
              Schema::dropIfExists('users');
        });
    }
};
