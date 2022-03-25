@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>WELCOME TO LEC MANAGEMENT INFORMATION SYSTEM</h1>
        <div class="col-md-6">
            <a href="/admin/login">

                <h1>Login as Admin </h1>
            </a>
        </div>
        <div class="col-md-6">
            <a href="/login">
                <h1>Login as Teacher </h1>
            </a>
            Dummy Teacher account for testing purpose:
            <br>
                email = sanoj.shrestha.13@gmail.com
                <br>
                password = password
        </div>
    </div>
</div>
@endsection
