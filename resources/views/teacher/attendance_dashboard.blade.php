@extends('layouts.app')

@section('content')

<?php
    ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>{{$subject->name}} batch name {{$batch}}</h2>
            <h2><a href="/teachers/attendance/<?=$batch?>/<?=$subject->subject_code?>/"><button class="btn btn-success"> Take today's attendance </button></h2></a>
        </div>
        <div class="col-8">
            Attendance history here
        </div>
    </div>
</div>
@endsection
