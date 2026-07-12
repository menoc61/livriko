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
        Schema::create('notification_logs', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->integer('user_id')->nullable();
            $blueprint->string('notification_type')->nullable(); // sms, email
            $blueprint->string('template_slug')->nullable();
            $blueprint->json('placeholders')->nullable();
            $blueprint->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $blueprint->text('error_message')->nullable();
            $blueprint->integer('retry_count')->default(0);
            $blueprint->timestamps();
            $blueprint->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};
