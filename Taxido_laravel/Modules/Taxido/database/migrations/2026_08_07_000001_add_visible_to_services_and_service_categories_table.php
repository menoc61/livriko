<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('visible')->default(true)->after('status');
        });

        Schema::table('service_categories', function (Blueprint $table) {
            $table->boolean('visible')->default(true)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('visible');
        });

        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn('visible');
        });
    }
};
