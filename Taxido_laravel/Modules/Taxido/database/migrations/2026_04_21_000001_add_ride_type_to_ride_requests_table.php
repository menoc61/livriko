<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('ride_requests', 'ride_type')) {
                $table->string('ride_type', 20)
                      ->nullable()
                      ->default('instant')
                      ->comment('instant | bidding')
                      ->after('driver_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            if (Schema::hasColumn('ride_requests', 'ride_type')) {
                $table->dropColumn('ride_type');
            }
        });
    }
};
