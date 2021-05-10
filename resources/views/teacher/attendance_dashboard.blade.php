@extends('layouts.app')

@section('content')

<?php
$noOfDays = $day - 1;
    ?>
<link rel="stylesheet" href="{{asset('css/attendance_table.css')}}">

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>{{$subject->name}} batch name {{$batch}}</h2>
            <h2><a href="/teachers/attendance/<?=$batch?>/<?=$subject->subject_code?>/"><button class="btn btn-success"> Take today's attendance. </button> Day {{$day}}</h2></a>
        </div>
        <div class="col-12">
            Attendance history here


            //////////////////////////////////////////////////////

            {{-- <button id="workHoursBtn" style="background: #00b3ee">workHoursBtn</button>
            <button id="vactionBtn" style="background: #ff0">vactionBtn</button>
            <button id="breakHoursBtn" style="background: #fff">breakHoursBtn</button> --}}

            <div class="page-TimeShifts page-BgGray js-TimeShifts">
                <div class="TShifts">
                    <table class="TShifts__table">
                        <thead>
                            <th class="Month">Roll</th>
                            <th class="Month">
                                Name
                            </th>
                            <?php for($i = 1; $i < $day; $i++){ ?>

                            <th colspan="1"><?= $i ?><small>Day</small></th>
                            <?php } ?>
                        </thead>
                        <tbody id="drawWorkTimeTableBody">


                            @foreach ($students as $student)

                            <tr class="">
                                <td><span class="text-bold font-weight-bolder">{{$student->roll}} </span></td>
                                <td> {{$student->name}}</td>
                                <?php for($i = 1; $i < $day; $i++){ ?>
                                <td class="justify-content-between pt-1 pl-2">
                                    <?php 
                                $attendance = $previousAttendances->where('roll_number',$student->roll_number)
                                ->where('day',$i)
                                ->pluck('attendance')[0];
                                ?>
                                    {{$attendance}}

                                </td>
                                <?php } ?>


                            </tr>
                            @endforeach





                        </tbody>
                    </table>

                </div>
                <div class="container">
                    <button id="save" style="background: green">save</button>
                    <div class="col-sm-6">

                        <div class="form-group form-group__half form-group__date">
                            <label class="control-label  ">Date</label>
                            <input type="text" data-datepicker="True" class="testdatepicker" id="getDate">
                        </div>
                    </div>

                </div>
            </div>




            ///////////////////////////////////////////////////////
        </div>
    </div>
</div>
@endsection
