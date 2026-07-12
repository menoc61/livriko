<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peak_zones', function (Blueprint $table) {
            if (!Schema::hasColumn('peak_zones', 'distance_price_percentage')) {
                $table->double('distance_price_percentage')->default(0)->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peak_zones', function (Blueprint $table) {
            $table->dropColumn('distance_price_percentage');
        });
    }
};
