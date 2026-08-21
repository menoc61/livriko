<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE services MODIFY COLUMN type VARCHAR(50) NOT NULL DEFAULT 'cab'");
        DB::statement("ALTER TABLE service_categories MODIFY COLUMN type VARCHAR(50) NOT NULL DEFAULT 'ride'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE services MODIFY COLUMN type ENUM('cab','parcel','freight','ambulance','finddriver') NOT NULL DEFAULT 'cab'");
        DB::statement("ALTER TABLE service_categories MODIFY COLUMN type ENUM('ride','intercity','rental','schedule','package','oneway','roundtrip','outstation','daily') NOT NULL DEFAULT 'ride'");
    }
};
