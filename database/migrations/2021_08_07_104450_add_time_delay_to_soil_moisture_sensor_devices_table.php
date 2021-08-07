<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeDelayToSoilMoistureSensorDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('soil_moisture_sensor_devices', function (Blueprint $table) {
            $table->integer('time_delay');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soil_moisture_sensor_devices', function (Blueprint $table) {
            $table->dropColumn(['time_delay']);
        });
    }
}
