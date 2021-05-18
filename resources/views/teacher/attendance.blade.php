@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/checkbox.css') }}">

<div class="container">
    <div class="row">
        <div class="col-md-8">

            <div class="float-right">
                {{$nepaliDate}}
                <div>{{$nameOfDay}}
                </div>
            </div>

            <h2>Attendance of <br>
                {{$subject->name}}</h2>
            <h2> <span>{{$batch}}th batch | Day {{$day}} </span></h2>
            <button class="btn btn-outline-success my-2" id="checkthis" onclick="checkAll()">Check all</button>

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
                <div class="pt-1">
                    <button type="submit" class="btn btn-success my-2"> Submit attendance</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script type="application/javascript">
    var clicked = false

    function checkAll() {
        clicked = !clicked

        let buttons = document.getElementsByClassName('checkboxid')
        if (clicked == true) {
            for (let button of buttons) {
                button.checked = true
            }
            document.getElementById("checkthis").innerHTML = "Uncheck All";

        } else {
            for (let button of buttons) {
                button.checked = false
            }
            document.getElementById("checkthis").innerHTML = "Check All";

        }

    }

</script>
