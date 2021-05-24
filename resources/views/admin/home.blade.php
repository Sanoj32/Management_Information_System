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
                    <ul class="list-group">
                        <a href="/admin/teachers">
                            <li class="list-group-item disabled font">Manage Attendance Permission</li>
                        </a>
                        <a href="/register">
                            <li class="list-group-item disabled">Register Teachers</li>
                        </a>
                        <a href="/admin/attendance">
                            <li class="list-group-item disabled">Close Attendance</li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
