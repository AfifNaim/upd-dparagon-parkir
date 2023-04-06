<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->integer('normal_bill')->default(0);
            $table->integer('extra_bill')->default(0);
            $table->integer('extra_time')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_configurations');
    }
}
