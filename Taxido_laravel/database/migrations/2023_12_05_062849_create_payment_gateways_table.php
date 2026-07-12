<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('serial')->nullable();
            $table->string('icon')->nullable();
            $table->longText('description')->nullable();
            $table->enum('mode', ['live', 'sandbox'])->default('sandbox');
            $table->json('configs')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('payment_gateways_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('item_id')->nullable();
            $table->decimal('amount', 8, 2)->default(0.0);
            $table->string('transaction_id')->unique()->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->enum('request_type', ['web', 'api'])->default('api')->nullable();
            $table->string('type')->nullable();
            $table->longText('redirect_url')->nullable();
            $table->integer('is_verified')->default(0);
            $table->timestamps();

            $table->index('item_id');
            $table->index('transaction_id');
            $table->index('payment_status');
            $table->index('is_verified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_gateways');
        Schema::dropIfExists('payment_gateways_transactions');
    }
};
