@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>WELCOME TO LEC MANAGEMENT INFORMATION SYSTEM</h1>
            <div>
                <a href="/admin/login">
                    <h1>Login as Admin </h1>
                </a>

            </div>
            <div>
                <a href="/login">
                    <h1>Login as Teacher </h1>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
