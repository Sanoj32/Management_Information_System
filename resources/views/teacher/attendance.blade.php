@extends('layouts.app')

@section('content')

<?php
    $students = \App\Models\BctStudent::all();
    ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3></h3>
            <h2>Attendance of BCT</h2>
            <form method="post" enctype="multipart/form-data" action="/test">
                @csrf
                @foreach($students as $student)
                <div class="input-group">
                    <input type="checkbox" id="<?= $student->name ?>" class="checkboxid" name="attendance[]" value="{{$student->roll_number}}" hidden />
                    <label for="<?= $student->name ?>" class="checkbox"><span class="text">{{$student->name}}</span><span class="icon"></span></label>
                </div>
                @endforeach
                <br>
                <div class="px-4">
                    <button type="submit" class="btn btn-success mx-4 float-left"> <span style="font-size: 20px">Submit attendance </span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
