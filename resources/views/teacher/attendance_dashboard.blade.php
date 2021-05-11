@extends('layouts.app')

@section('content')

<?php
$noOfDays = $day - 1;
    ?>
<link rel="stylesheet" href="{{asset('css/attendance_table.css')}}">
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>{{$subject->name}} </h2>
            <h2 class="pb-2">{{$batch}}th batch | Day {{$day}}</h2>
            <h2><a href="/teachers/attendance/<?=$batch?>/<?=$subject->subject_code?>/"><button class="btn btn-success mb-3 px-3"> Take today's attendance. </button></a> </h2>
            <h2><a href="/teachers/attendance/<?=$batch?>/<?=$subject->subject_code?>/edit"><button class="btn btn-dark mb-3 px-3"> Edit today's attendance. </button></a> </h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="page-TimeShifts page-BgGray js-TimeShifts ml-3">
                    <div class="TShifts">
                        <table class="TShifts__table">
                            <thead>
                                <th class="Month border-white border-right px-1">Roll</th>
                                <th class="Month border-white border-right">
                                    Name
                                </th>
                                <?php for($i = 1; $i < $day; $i++){ ?>

                                <th class="border-white border-right px-1"> <small>Day </small><?= $i ?></th>
                                <?php } ?>
                            </thead>
                            <tbody id="drawWorkTimeTableBody">


                                @foreach ($students as $student)

                                <tr style="text-align:center;">
                                    <td><span class="text-bold font-weight-bolder">{{$student->roll}} </span></td>
                                    <td> {{$student->name}} </td>
                                    <?php for($i = 1; $i < $day; $i++){ ?>
                                    <td class="">
                                        <?php 
                                $attendance = $previousAttendances->where('roll_number',$student->roll_number)
                                ->where('day',$i)
                                ->pluck('attendance')[0];
                                ?>
                                        @if($attendance == "P")
                                        {{$attendance}}
                                        @else
                                        <span class="text text-danger">{{$attendance}} </span>
                                        @endif


                                    </td>
                                    <?php } ?>


                                </tr>
                                @endforeach





                            </tbody>
                        </table>

                    </div>

                </div>
            </div>



        </div>
    </div>
</div>
@endsection
