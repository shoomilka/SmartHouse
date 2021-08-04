<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SoilMoistureSensorValue;
use DB;

class SoilMoistureSensorDevice extends Model
{
    use HasFactory;

    public function lastValue() {
        return $this->hasMany(SoilMoistureSensorValue::class, 'serial_number', 'serial_number')
            ->select('soil_moisture_sensor_values.*')
            ->join(DB::raw('(Select max(id) as id from soil_moisture_sensor_values group by serial_number) LatestValue'), function($join) {
               $join->on('soil_moisture_sensor_values.id', '=', 'LatestValue.id');
               })
            ->orderBy('created_at', 'desc');
    }
}
