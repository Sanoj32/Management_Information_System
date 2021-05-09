@extends('layouts.app')

@section('content')

<?php
    {{-- $students = App\Models\BctStudent::all(); --}}
    ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3></h3>
            <h2>{{$subject->name}}</h2>
            <h3></h3>
        </div>
    </div>
</div>
@endsection
