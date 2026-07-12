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
        Schema::create('countries', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255)->nullable();
			$table->string('currency', 255)->nullable();
			$table->longText('currency_symbol')->nullable();
			$table->string('iso_3166_2', 2)->nullable();
			$table->string('iso_3166_3', 3)->nullable();
			$table->string('calling_code', 3)->nullable();
			$table->string('flag')->nullable();
            $table->string('currency_code', 255)->nullable();

            $table->index('name');
            $table->index('currency_code');
            $table->index('calling_code');
            $table->index('flag');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
};
