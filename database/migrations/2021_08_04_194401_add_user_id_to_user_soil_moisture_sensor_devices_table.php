<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToUserSoilMoistureSensorDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_soil_moisture_sensor_devices', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_soil_moisture_sensor_devices', function (Blueprint $table) {
            $table->dropColumn(['user_id']);
        });
    }
}
