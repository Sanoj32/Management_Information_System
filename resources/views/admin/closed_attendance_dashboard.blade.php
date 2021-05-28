@extends('layouts.app')

@section('content')

<?php
use Krishnahimself\DateConverter\DateConverter;
use App\Models\BctAttendance;
$student = $students->first();
$totalClasses = $student->totalDays;


                            ?>
<link rel="stylesheet" href="{{asset('css/attendance_table.css')}}">
<div class="container">
    <div class="row">

        <div class="col-md-8">
            <h2>{{$subject->name}} </h2>
            <h2>{{$batch}}th batch</h2>
            <h3>Total Classes = {{$student->totalDays}}</h3>

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pl-3 py-2">
            <h2 class="pt-2"> This attendance has been closed.</h2>
            <div class="page-TimeShifts page-BgGray js-TimeShifts">
                <div class="TShifts" style="overflow-x:auto;">
                    <table class="TShifts__table">
                        <thead>
                            <th class="Month border-white border-right px-1 " style="min-width:3px max-width:5px">Roll</th>

                            <th class="Month border-white border-right" style=" min-width:10px; max-width:15px;">
                                Name
                            </th>
                            <th class="Month border-white border-right" style=" min-width:10px; max-width:15px;">
                                Present Days
                            </th>
                            <th class="Month border-white border-right" style=" min-width:10px; max-width:15px;">
                                Present Percentage
                            </th>

                            {{-- Calculate Nepali day of the date of attendance history
                            And this is the column loop -- day>=2 meaning atleast one attendance is required for this to show up --}}

                        </thead>
                        <tbody id="drawWorkTimeTableBody">

                            {{-- This is the row loop --}}
                            @foreach ($students as $student)
                            <tr style="text-align:center;">
                                <td><span class="text-bold font-weight-bolder">{{$student->roll}} </span></td>
                                <td> {{$student->name}} </td>
                                <td class="px-2"> {{$student->presentDays}} </td>
                                <td class="px-2"> {{$student->presentPercent}} </td>
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
