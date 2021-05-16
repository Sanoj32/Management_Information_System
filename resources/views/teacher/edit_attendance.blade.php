@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">

<div class="container">
    <div class="row">

        <div class="col-md-8">
            <h2>EDIT Attendance of <br>
                {{$subject->name}}</h2>
            <h2> <span>{{$batch}}th batch | Day {{$day}} </span></h2>
            <form method="post" enctype="multipart/form-data" action="/teachers/attendance/<?=$batch ?>/<?= $subject->subject_code ?>/ <?= $lastDay ?>">
                @csrf
                {{ method_field('PATCH') }}
                @foreach($students as $student)
                <?php $roll = substr($student->roll_number,-2);
                $prev = $previousAttendance->where('roll_number',$student->roll_number)->first();
                 ?>
                <div class="input-group">
                    <input type="checkbox" id="<?= $student->name ?>" <?php
                        if($prev->attendance == "P"){
                            echo "checked";
                        }
                        ?> class="checkboxid" name="attendance[]" value="{{$student->roll_number}}" hidden />
                    <label for="<?= $student->name ?>" class="checkbox"><span class="text"><span style="font-size:20px; font-weight:bold">{{$roll}}</span> <span class="pl-2">{{$student->name}}</span></span><span class="icon"></span></label>
                </div>

                @endforeach
                <button type="submit" class="btn btn-secondary"> Update attendance</button>
            </form>
        </div>
    </div>
</div>
@endsection
