<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoilMoistureSensorDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soil_moisture_sensor_devices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('serial_number');
            $table->string('color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soil_moisture_sensor_devices');
    }
}
