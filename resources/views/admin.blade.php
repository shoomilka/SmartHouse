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

                    <div class="list-group">
                        @foreach($users as $user)
                        <a href="/admin/{{ $user->id }}" class="list-group-item list-group-item-action @if($user->is_admin) active @endif">{{ $user->name }}</a>
                        @endforeach
                        <div class="d-flex justify-content-center" style="margin-top: 15px;">{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
