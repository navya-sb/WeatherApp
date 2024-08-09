<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('description');
            $table->float('temperature');
            $table->integer('humidity');
            $table->float('wind_speed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('weather_forecasts');
    }
};
