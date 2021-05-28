@extends('layouts.app')

@section('content')

<?php
use Krishnahimself\DateConverter\DateConverter;
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

            <h3 class="pb-2"><?php echo getNameOfDay($dateNow->dayOfWeek) ?> :- {{$nepaliDateToday}}</h3>
            <h4>Total classes = {{$totalClasses}}</h4>



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

                        <th class=" border-white border-right px-1" style="min-width: 2px"><?= $i ?>
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
                            <td style="border-right: 1px solid #000000 !important;
">
                                <?php
                                    $presentClasses = 0;
                                        for($i = $totalClasses; $i >=1 ; $i--){
                                $attendance = $previousAttendances->where('roll_number',$student->roll_number)
                                                                        ->where('day',$i)
                                                                        ->pluck('attendance')[0];
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
        <form class="pt-4" method="POST" action="/admin/attendance/close/<?=$batch?>/<?=$subject->subject_code?>">
            @csrf
            <button type=" submit" id="closeAttendance" class="btn btn-danger"> Close Attendance </button>
            <span class="pl-3"> WARNING!!! This process is irreversible. Attendances should only be closed after all classes are finished.</span>


        </form>

    </div>

</div>
@endsection

<script type="application/javascript">
    function askConfirmation() {
        var subjectCode = "<?php echo $subject->subject_code ?>";
        var batch = "<?php echo $batch ?>";
        console.log(batch, subjectCode)
        if (confirm("Do you want to close this attendance? This process is irreversible!") == true) {
            axios.post("/admin/attendance/close/" + batch + "/" + subjectCode)
        }
    }

</script>
