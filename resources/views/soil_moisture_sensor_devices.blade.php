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
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>Name</th>
                                    <th>Time Delay</th>
                                    <th>Color</th>
                                    <th>Value</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @foreach($devices as $device)
                            <tr>
                                <td>{{ $device->serial_number }}</td>
                                <td>{{ $device->name }}</td>
                                <td>{{ $device->getTimeDelay() }}</td>
                                <td>{{ $device->getColor() }}</td>
                                <td>
                                    @if(!$device->lastValue())
                                    Device is not connected
                                    @else
                                    @if($device->lastValue()->value)
                                    Зволожено
                                    @else
                                    Сухо
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if(!$device->lastValue())
                                    Device is not connected
                                    @else
                                    {{ date('l jS F Y h:i:s A', strtotime($device->lastValue()->created_at)) }}
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary rename" style="margin-bottom: 5px; width: 100%;" data-id="{{ $device->id }}">Rename</button>
                                    <button class="btn btn-secondary change_time_delay" style="width: 100%;" data-serial_number="{{ $device->serial_number }}">Change Time Delay</button>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="rename_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename Sensor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/dashboard">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">New Device's Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="change_time_delay_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Time Delay</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/soil_moisture_sensor_devices">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="serial_number" value="" />
                    <div class="form-group">
                        <label for="time_delay">New Device's Time Delay</label>
                        <select class="form-control" name="time_delay">
                            <option value="3600000">1 hour</option>
                            <option value="7200000">2 hour</option>
                            <option value="10800000">3 hour</option>
                            <option value="14400000">4 hour</option>
                            <option value="18000000">5 hour</option>
                            <option value="21600000">6 hour</option>
                            <option value="25200000">7 hour</option>
                            <option value="28800000">8 hour</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
<script>
    $(document).ready(function() {
        $('.rename').on('click', function() {
            $('#rename_modal').modal('show');
            $('#rename_modal form').attr('action', '/dashboard/' + $(this).data('id'));
        });

        $('.change_time_delay').on('click', function() {
            $('#change_time_delay_modal').modal('show');
            $('#change_time_delay_modal [name="serial_number"]').val($(this).data('serial_number'));
        });
    });
</script>
@endsection
