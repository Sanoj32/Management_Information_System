@extends('layouts.app')

@section('content')

<?php
use Krishnahimself\DateConverter\DateConverter;
use App\Models\BctAttendance;
$nepaliDateToday = DateConverter::fromEnglishDate($dateNow->year, $dateNow->month, $dateNow->day)->toNepaliDate();
$noOfDays = $day - 1;
$lastDay = $noOfDays;

//get a student from the list to find out the number of classes that happened in this subject
$totalClasses = $previousAttendances->count() / $students->count();

 //Get the nepali date of latest attendance taken
$thisAttendance =  $previousAttendances->where('day',$day - 1)->first(); // Get the attendance of this specific column
if($thisAttendance != null){
    $attendanceDate = $thisAttendance->created_at;
    $attendanceDate = $thisAttendance->created_at;
    $nepaliDate = DateConverter::fromEnglishDate($thisAttendance->created_at->year, $thisAttendance->created_at->month, $thisAttendance->created_at->day)->toNepaliDate();
    $nepaliMonth = explode('-',$nepaliDate,3)[1];
    $nepaliDay = explode('-',$nepaliDate,3)[2];
}else{
    $nepaliDate = null;
}
                            ?>
<link rel="stylesheet" href="{{asset('css/attendance_table.css')}}">
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>{{$subject->name}} </h2>
            <h2>{{$batch}}th batch | Day {{$day}}</h2>
            <h3 class="pb-2"><?php echo getNameOfDay($dateNow->dayOfWeek) ?> :- {{$nepaliDateToday}}</h3>
            @if($nepaliDateToday == $nepaliDate)
            <h4 class="my-3 py-2 ">

                <span> Attendance saved. <span> <a class=" pl-2" href="/teachers/attendance/<?=$batch?>/<?=$subject->subject_code?>/<?=$day?>"><button class="btn btn-outline-secondary mb-3" id="takeattendance"> Take again?</button></a></h4>
            @else
            <h2><a href="/teachers/attendance/<?=$batch?>/<?=$subject->subject_code?>/<?=$day?>"><button class="btn btn-success mb-3 px-3" id="takeattendance"> Take today's attendance. </button></a> </h2>
            @endif
            @if($previousAttendances->isNotEmpty() )

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Edit Attendance
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @for($i = $day - 1; $i >= 1; $i--) <a class="dropdown-item" href="/teachers/attendance/<?=$batch?>/<?=$subject->subject_code?>/<?=$i; ?>/edit">Day <?=$i?></a> @endfor

                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="row pl-1">
    <div class="col-md-12 pl-4 py-2">
        <h2 class="pt-2">Attendance History</h2>
        <div class="page-TimeShifts page-BgGray js-TimeShifts">
            <div class="TShifts" style="overflow-x:auto;">
                <table class="TShifts__table">
                    <thead>
                        <th class="Month border-white border-right px-1 " style="min-width:3px max-width:5px">Roll</th>

                        <th class="Month border-white border-right" style=" min-width:10px; max-width:15px;">
                            Name
                        </th>
                        {{-- Display the latest attendance in this first column just the head part --}}
                        @if($day >= 6) {{-- day >=6 meaning atleast 5 attendance are required for the latest on 1st col and P/T tab to show up --}}

                        {{-- Display the Present/Absent Ratio --}}
                        <th class="border-white border-right px-1" style="min-width: 2px">Present Count
                        </th>

                        <th class="border-white border-right px-1" style="min-width: 2px;"><?= $day - 1 ?>

                            <div>
                                @if($nepaliDate != null && $nepaliDateToday == $nepaliDate)
                                Today
                                @else
                                {{$nepaliMonth}}|{{$nepaliDay}}
                                @endif
                            </div>
                        </th>



                        <?php for($i = $day - 2; $i >= 1 ; $i--){
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
                        <?php for($i = $day - 1; $i >= 1; $i--){
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
                            <td style="border-right: 1px solid #000000 !important;">
                                <?php
                                    $presentClasses = 0;
                                        for($i = $totalClasses; $i >=1 ; $i--){
                                $attendance = $previousAttendances->where('roll_number',$student->roll_number)
                                                                        ->where('day',$i)
                                                                        ->pluck('attendance')[0]; // Possible error source here due to not all rows being deleted after closing the attendance.
                                                                    if($attendance == "P"){
                                                                        $presentClasses += 1;
                                                                    }
                                                                 }

                                ?>

                                {{$presentClasses}}
                            </td>

                            {{-- Display the latest attendance taken in the first column as P and A --}}

                            <td class="today">
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
                            <?php for($i = $day - 2 ; $i >= 1; $i--){ ?>
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
                            <?php for($i = $day - 1; $i >= 1; $i--){ ?>
                            <td>
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
