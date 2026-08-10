<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('ride_requests', 'total_seats')) {
                $table->unsignedInteger('total_seats')->nullable()->default(null)->after('package_type');
            }
            if (!Schema::hasColumn('ride_requests', 'booked_seats')) {
                $table->unsignedInteger('booked_seats')->nullable()->default(1)->after('total_seats');
            }
            if (!Schema::hasColumn('ride_requests', 'available_seats')) {
                $table->unsignedInteger('available_seats')->nullable()->default(null)->after('booked_seats');
            }
        });

        Schema::table('rides', function (Blueprint $table) {
            if (!Schema::hasColumn('rides', 'total_seats')) {
                $table->unsignedInteger('total_seats')->nullable()->default(null)->after('description');
            }
            if (!Schema::hasColumn('rides', 'booked_seats')) {
                $table->unsignedInteger('booked_seats')->nullable()->default(1)->after('total_seats');
            }
            if (!Schema::hasColumn('rides', 'available_seats')) {
                $table->unsignedInteger('available_seats')->nullable()->default(null)->after('booked_seats');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            foreach (['available_seats', 'booked_seats', 'total_seats'] as $column) {
                if (Schema::hasColumn('ride_requests', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('rides', function (Blueprint $table) {
            foreach (['available_seats', 'booked_seats', 'total_seats'] as $column) {
                if (Schema::hasColumn('rides', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
