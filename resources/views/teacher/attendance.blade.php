@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <h2>Attendance of </h2>
            <h2> {{$subject->name}}</h2>
            <h2> <span>{{$batch}}th batch | Day {{$day}} </span></h2>
            <form method="POST" enctype="multipart/form-data" action="/teachers/attendance/<?=$batch ?>/<?= $subject->subject_code ?>/ <?= $day ?>">
                @csrf
                @foreach($students as $student)
                <?php $roll = substr($student->roll_number,-2);
                 ?>
                <div class="input-group">
                    <input type="checkbox" id="<?= $student->name ?>" class="checkboxid" name="attendance[]" value="{{$student->roll_number}}" hidden />
                    <label for="<?= $student->name ?>" class="checkbox"><span class="text"><span style="font-size:20px; font-weight:bold">{{$roll}}</span> <span class="pl-2">{{$student->name}}</span></span><span class="icon"></span></label>
                </div>

                @endforeach
                <button type="submit" class="btn btn-success"> Submit attendance</button>
            </form>
        </div>
    </div>
</div>
@endsection
