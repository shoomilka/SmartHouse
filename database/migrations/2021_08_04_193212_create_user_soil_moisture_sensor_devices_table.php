<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSoilMoistureSensorDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_soil_moisture_sensor_devices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('serial_number');
            $table->string('name');
        });

        Schema::table('auth_tokens', function (Blueprint $table) {
            $table->dropColumn(['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('auth_tokens', function (Blueprint $table) {
            $table->string('name');
        });
        
        Schema::dropIfExists('user_soil_moisture_sensor_devices');
    }
}
