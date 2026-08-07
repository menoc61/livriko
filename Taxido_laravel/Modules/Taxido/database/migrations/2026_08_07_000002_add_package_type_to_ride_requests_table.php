<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('ride_requests', 'package_type')) {
                $table->string('package_type', 40)
                      ->nullable()
                      ->default(null)
                      ->comment('documents | clothing | food | electronics | fragile | other')
                      ->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            if (Schema::hasColumn('ride_requests', 'package_type')) {
                $table->dropColumn('package_type');
            }
        });
    }
};
