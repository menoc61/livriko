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
        Schema::table('ride_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('current_driver_id')->nullable();
            $table->json('rejected_driver_ids')->nullable();
            $table->timestamp('driver_acceptance_expires_at')->nullable();
            $table->timestamp('find_driver_expires_at')->nullable();
            
            $table->foreign('current_driver_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ride_requests', function (Blueprint $table) {
            $table->dropForeign(['current_driver_id']);
            $table->dropColumn(['current_driver_id', 'rejected_driver_ids', 'driver_acceptance_expires_at', 'find_driver_expires_at']);
        });
    }
};
