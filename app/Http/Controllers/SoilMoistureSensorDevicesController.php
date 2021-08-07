<?php

namespace App\Http\Controllers;

use App\Models\SoilMoistureSensorDevice;
use Illuminate\Http\Request;
use App\Models\UserSoilMoistureSensorDevice;

class SoilMoistureSensorDevicesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = UserSoilMoistureSensorDevice::orderBy('serial_number', 'desc')->paginate(20);

        return view('soil_moisture_sensor_devices', ['devices' => $devices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serial_number = $request->input('serial_number');
        if (!in_array((int)$request->input('time_delay'), [3600000, 7200000, 10800000, 14400000, 18000000, 21600000, 25200000, 28800000])) {
            return back()->withErrors('Incorrect Time Delay value!');
        }
        if (SoilMoistureSensorDevice::where('serial_number', $serial_number)->count() == 0) {
            return back()->withErrors('Device does not exist!');
        }
        $device = SoilMoistureSensorDevice::where('serial_number', $serial_number)->first();
        $device->time_delay = (int)$request->input('time_delay');
        $device->save();
        return redirect('soil_moisture_sensor_devices');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
