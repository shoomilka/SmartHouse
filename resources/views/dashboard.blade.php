@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table>
                    <tr><td>Serial Number</td><td>Name</td><td>Value</td><td>Time</td></tr>
                    @foreach($devices as $device)
                    <tr>
                        <td>{{ $device->serial_number }}</td>
                        <td>{{ $device->name }}</td>
                        <td>
                            @if($device->lastSoilMoistureSensorValue()->first()->value)
                            Зволожено
                            @else
                            Сухо
                            @endif
                        </td>
                        <td>{{ date('l jS F Y h:i:s A', strtotime($device->lastSoilMoistureSensorValue()->first()->created_at)) }}</td></tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
