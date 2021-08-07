@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Admin Panel</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div>
                        <p>ID: <b>{{ $user->id }}</b></p>
                        <p>Name: <b>{{ $user->name }}</b></p>
                        <p>Email: <b>{{ $user->email }}</b></p>
                        <p>
                            <form method="POST" action="/admin/{{ $user->id }}">
                            @csrf
                            @method('PUT')
                            @if($user->is_admin)
                            <button class="btn btn-danger" @if(Auth::id() == $user->id) disabled @endif>Remove from admins</button>
                            @else
                            <button class="btn btn-primary">Add to admins</button>
                            @endif
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
