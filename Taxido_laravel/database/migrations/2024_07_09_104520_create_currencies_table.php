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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('symbol')->nullable();
            $table->string('flag')->nullable();
            $table->decimal('no_of_decimal')->default(2)->nullable();
            $table->double('exchange_rate')->default(1)->nullable();
            $table->enum('symbol_position',['before_price','after_price'])->default('before_price')->nullable();
            $table->enum('thousands_separator',['comma','period','space'])->default('comma')->nullable();
            $table->enum('decimal_separator',['comma','period','space'])->default('comma')->nullable();
            $table->integer('system_reserve')->default(0);
            $table->integer('status')->default(1)->nullable();
            $table->bigInteger('created_by_id')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');

            $table->index('code');
            $table->index('symbol');
            $table->index('exchange_rate');
            $table->index('status');
            $table->index('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
