@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="/dashboard/create" class="btn btn-primary float-right">Add Device</a></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="list-group">
                        <a href="/soil_moisture_sensor_devices" class="list-group-item list-group-item-action">Soil Moisture Sensor Devices</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
