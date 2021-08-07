<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\AuthToken;
use App\Models\UserSoilMoistureSensorDevice;
use Auth;

class DashboardController extends Controller
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
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $r = $request->all();
        $validator = Validator::make($r, [
            'name'          => 'required|min:1',
            'serial_number' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        if (!AuthToken::where('serial_number', $request->input('serial_number'))->count()) {
            return back()->withInput()->withErrors('Serial number does not exist.');
        }
        if (UserSoilMoistureSensorDevice::where('user_id', Auth::user()->id)->where('serial_number', $request->input('serial_number'))->count() > 0) {
            return back()->withInput()->withErrors('This sensor was added before!');
        }
        $device = new UserSoilMoistureSensorDevice();
        $device->name = $request->input('name');
        $device->user_id = Auth::user()->id;
        $device->serial_number = $request->input('serial_number');
        $device->save();

        return redirect('/soil_moisture_sensor_devices');
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
        $r = $request->all();
        $validator = Validator::make($r, [
            'name'          => 'required|min:1',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        if (UserSoilMoistureSensorDevice::where('user_id', Auth::user()->id)->where('id', $id)->count() < 1) {
            return back()->withInput()->withErrors('This sensor was not added!');
        }
        $device = UserSoilMoistureSensorDevice::where('user_id', Auth::user()->id)->where('id', $id)->first();
        $device->name = $request->input('name');
        $device->save();

        return redirect('/soil_moisture_sensor_devices');
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
