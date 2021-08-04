@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Your Soil Moisture Sensor Devices') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="d-flex justify-content-center">{{ $devices->links() }}</div>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Serial Number</th>
                                <th>Name</th>
                                <th>Color</th>
                                <th>Value</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        @foreach($devices as $device)
                        <tr>
                            <td>{{ $device->serial_number }}</td>
                            <td></td>
                            <td>{{ $device->color }}</td>
                            <td>
                                @if($device->lastValue()->first()->value)
                                Зволожено
                                @else
                                Сухо
                                @endif
                            </td>
                            <td>{{ date('l jS F Y h:i:s A', strtotime($device->lastValue()->first()->created_at)) }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
