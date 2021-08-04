@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add New Device</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="/dashboard">
                        @csrf
                        <div class="form-group">
                            <label for="name">Device's Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="serial_number">Device's Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" placeholder="Enter Serial Number">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
