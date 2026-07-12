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
        if (!Schema::hasTable('chat_rooms')) {
            Schema::create('chat_rooms', function (Blueprint $table) {
                $table->id();
                $table->string('room_id')->unique();
                $table->json('participants')->nullable();
                $table->json('last_message')->nullable();
                $table->json('unread_count')->nullable(); // { "user_id": 5 }
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('chat_messages')) {
            Schema::create('chat_messages', function (Blueprint $table) {
                $table->id();
                $table->string('room_id');
                $table->unsignedBigInteger('sender_id');
                $table->unsignedBigInteger('receiver_id');
                $table->string('sender_name')->nullable();
                $table->string('receiver_name')->nullable();
                $table->text('message')->nullable();
                $table->json('images')->nullable();
                $table->boolean('is_read')->default(false);
                $table->json('cleared_by')->nullable();
                $table->timestamps();

                $table->index('room_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_rooms');
    }
};
