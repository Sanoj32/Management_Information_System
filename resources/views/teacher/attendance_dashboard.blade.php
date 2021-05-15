@extends('layouts.app')

@section('content')

<?php
use Krishnahimself\DateConverter\DateConverter;
$nepaliDateToday = DateConverter::fromEnglishDate($dateNow->year, $dateNow->month, $dateNow->day)->toNepaliDate();
$noOfDays = $day - 1;
$lastDay = $noOfDays;

//get a student from the list to find out the number of classes that happened in this subject
$totalClasses = $previousAttendances->count() / $students->count();

    ?>
<link rel="stylesheet" href="{{asset('css/attendance_table.css')}}">
<div class="container">
    <div class="row">
        @if (session('attendanceSuccess'))
        <div class="alert alert-success">
            {{ session('attendanceSuccess') }}
        </div>
        @endif

        @if (session('attendanceUpdateSuccess'))
        <div class="alert alert-success">
            {{ session('attendanceUpdateSuccess') }}
        </div>
        @endif
        <div class="col-md-8">
            <h2>{{$subject->name}} </h2>
            <h2>{{$batch}}th batch | Day {{$day}}</h2>
            <h3 class="pb-2"><?php echo getNameOfDay($dateNow->dayOfWeek) ?> :- {{$nepaliDateToday}}</h3>
            <h2><a href="/teachers/attendance/<?=$batch?>/<?=$subject->subject_code?>/"><button class="btn btn-success mb-3 px-3"> Take today's attendance. </button></a> </h2>
            @if($previousAttendances->isNotEmpty() )
            <h2><a href="/teachers/attendance/<?=$batch?>/<?=$subject->subject_code?>/<?=$lastDay; ?>/edit"><button class="btn btn-secondary mb-3 px-3"> Edit Today's attendance. </button></a> </h2>
            @endif


        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Attendance History</h2>
            <div class="page-TimeShifts page-BgGray js-TimeShifts">
                <div class="TShifts " style="overflow-x:auto;">
                    <table class="TShifts__table">
                        <thead>
                            <th class="Month border-white border-right px-1 " style="min-width:3px max-width:5px">Roll</th>

                            <th class="Month border-white border-right" style=" min-width:10px; max-width:15px;">
                                Name
                            </th>
                            {{-- Display the latest attendance in this first column just the head part --}}
                            @if($day >= 6) {{-- day >=6 meaning atleast 5 attendance are required for the latest on 1st col and P/T tab to show up --}}

                            {{-- Display the Present/Absent Ratio --}}
                            <th class="border-white border-right px-1" style="min-width: 2px">P/T
                            </th>

                            <th class="border-white border-right px-1" style="min-width: 2px"><?= $day - 1 ?>
                                <?php
                            $thisAttendance =  $previousAttendances->where('day',$day - 1)->first(); // Get the attendance of this specific column
                                $attendanceDate = $thisAttendance->created_at;
                                $nepaliDate = DateConverter::fromEnglishDate($thisAttendance->created_at->year, $thisAttendance->created_at->month, $thisAttendance->created_at->day)->toNepaliDate();
                                $nepaliMonth = explode('-',$nepaliDate,3)[1];
                                $nepaliDay = explode('-',$nepaliDate,3)[2];
                            ?>
                                <div>
                                    @if($nepaliDateToday == $nepaliDate)
                                    Today
                                    @else
                                    {{$nepaliMonth}}|{{$nepaliDay}}
                                    @endif
                                </div>
                            </th>



                            <?php for($i = 1; $i < $day - 1; $i++){
                                $thisAttendance =  $previousAttendances->where('day',$i)->first(); // Get the attendance of this specific column
                                $attendanceDate = $thisAttendance->created_at;
                                $nepaliDate = DateConverter::fromEnglishDate($thisAttendance->created_at->year, $thisAttendance->created_at->month, $thisAttendance->created_at->day)->toNepaliDate();
                                $nepaliMonth = explode('-',$nepaliDate,3)[1];
                                $nepaliDay = explode('-',$nepaliDate,3)[2];
                                 ?>

                            <th class="border-white border-right px-1" style="min-width: 2px"><?= $i ?>
                                <div>{{$nepaliMonth}}|{{$nepaliDay}}</div>
                            </th>
                            <?php } ?>

                            @else
                            <?php for($i = 1; $i < $day; $i++){
                                $thisAttendance =  $previousAttendances->where('day',$i)->first(); // Get the attendance of this specific column
                                $attendanceDate = $thisAttendance->created_at;
                                $nepaliDate = DateConverter::fromEnglishDate($thisAttendance->created_at->year, $thisAttendance->created_at->month, $thisAttendance->created_at->day)->toNepaliDate();
                                $nepaliMonth = explode('-',$nepaliDate,3)[1];
                                $nepaliDay = explode('-',$nepaliDate,3)[2];
                                 ?>

                            <th class="border-white border-right px-1" style="min-width: 2px"><?= $i ?>
                                <div>
                                    @if($nepaliDateToday == $nepaliDate)
                                    Today
                                    @else
                                    {{$nepaliMonth}}|{{$nepaliDay}}
                                    @endif
                                </div>
                            </th>
                            <?php } ?>
                            @endif


                            {{-- Calculate Nepali day of the date of attendance history 
                            And this is the column loop -- day>=2 meaning atleast one attendance is required for this to show up --}}



                        </thead>
                        <tbody id="drawWorkTimeTableBody">

                            {{-- This is the row loop --}}
                            @foreach ($students as $student)

                            <tr style="text-align:center;">
                                <td><span class="text-bold font-weight-bolder">{{$student->roll}} </span></td>

                                <td> {{$student->name}} </td>

                                @if($day >= 6)
                                {{-- Display the P/T tab --}}
                                <td>
                                    <?php
                                    $presentClasses = 0;
                                        for($i = 1; $i <= $totalClasses; $i++){
                                $attendance = $previousAttendances->where('roll_number',$student->roll_number)
                                                                        ->where('day',$i)
                                                                        ->pluck('attendance')[0];
                                                                    if($attendance == "P"){
                                                                        $presentClasses += 1;
                                                                    }
                                                                 }

                                ?>
                                    {{$presentClasses}}/{{$totalClasses}}
                                </td>

                                {{-- Display the latest attendance taken in the first column as P and A --}}

                                <td>
                                    <?php
                                $attendance = $previousAttendances->where('roll_number',$student->roll_number)
                                ->where('day',$day - 1)
                                ->pluck('attendance')[0];
                                ?>
                                    @if($attendance == "P")
                                    {{$attendance}}
                                    @else
                                    <span class="text text-danger">{{$attendance}} </span>
                                    @endif
                                </td>




                                {{-- //loop for getting the attendance of the rest of the days except latest --}}
                                <?php for($i = 1; $i < $day - 1; $i++){ ?>
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
                                @else
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
                                @endif

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
