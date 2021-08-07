<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/dashboard', 'App\Http\Controllers\DashboardController')->names([
    'index'     => 'dashboard.index',
    'create'    => 'dashboard.create',
    'store'     => 'dashboard.store',
    'update'    => 'dashboard.update',
]);

Route::resource('/soil_moisture_sensor_devices', 'App\Http\Controllers\SoilMoistureSensorDevicesController')->names([
    'index'     => 'soil_moisture_sensor_devices.index',
]);

Route::resource('/admin', 'App\Http\Controllers\AdminController')->names([
    'index'     => 'admin.index',
    'show'      => 'admin.show',
    'update'    => 'admin.update',
]);
