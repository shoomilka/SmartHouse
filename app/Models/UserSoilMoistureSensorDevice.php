<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SoilMoistureSensorValue;
use DB;

class UserSoilMoistureSensorDevice extends Model
{
    use HasFactory;

    public function lastValue() {
        return $this->hasMany(SoilMoistureSensorValue::class, 'serial_number', 'serial_number')
            ->select('soil_moisture_sensor_values.*')
            ->join(DB::raw('(Select max(id) as id from soil_moisture_sensor_values group by serial_number) LatestValue'), function($join) {
               $join->on('soil_moisture_sensor_values.id', '=', 'LatestValue.id');
               })
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function getColor() {
        return $this->hasOne(SoilMoistureSensorDevice::class, 'serial_number', 'serial_number')->first()->color;
    }

    public function getTimeDelay() {
        $time_delay = $this->hasOne(SoilMoistureSensorDevice::class, 'serial_number', 'serial_number')->first()->time_delay;
        $time_delay = $time_delay / 3600000;
        return $time_delay . " hour" . ($time_delay < 2 ? "" : "s");
    }

    public function lastWetTime() {
        return $this->hasMany(SoilMoistureSensorValue::class, 'serial_number', 'serial_number')
            ->select('soil_moisture_sensor_values.*')
            ->join(DB::raw('(Select max(id) as id from soil_moisture_sensor_values where value = 1 group by serial_number) LatestWetValue'), function($join) {
               $join->on('soil_moisture_sensor_values.id', '=', 'LatestWetValue.id');
               })
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function dryFrom() {
        $firstDryAfterWet = $this->hasMany(SoilMoistureSensorValue::class, 'serial_number', 'serial_number')
            ->select('soil_moisture_sensor_values.*')
            ->join(DB::raw('(Select min(id) as id from soil_moisture_sensor_values where value = 0 AND created_at > "'. $this->lastWetTime()->created_at .'" group by serial_number) DryFrom'), function($join) {
               $join->on('soil_moisture_sensor_values.id', '=', 'DryFrom.id');
               })
            ->orderBy('created_at', 'desc')
            ->first();
        if (!$firstDryAfterWet) return $this->lastWetTime();
        return $firstDryAfterWet;
    }
}
