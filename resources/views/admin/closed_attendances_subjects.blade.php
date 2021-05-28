@extends('layouts.app')
@section('content')
<?php 
use App\Models\BctSubject;
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Closed Attendances</h2>
            @foreach ($semesters as $semester)

            <div class="card">
                <div class="card-header">{{getSemester($semester)}} semester</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($subject_codes as $sub_code)
                        <?php $subject = BctSubject::where('subject_code',$sub_code)->first(); ?>
                        @if($subject->semester == $semester)

                        <a href="/admin/closed/attendancedashboard/<?=$batch?>/<?=$sub_code?>">
                            <li class="list-group-item disabled">{{$subject->name}}</li>
                        </a>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <br>
            @endforeach
        </div>
    </div>
</div>
@endsection
