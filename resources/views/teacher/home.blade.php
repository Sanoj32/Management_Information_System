@extends('layouts.app')

@section('content')
<?php
use App\Models\BctSubject;

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>My attendance</h2>

                </div>


                <div class="card-body pb-2">


                    @if($teacher->bctSubjects->isNotEmpty() )
                    <ul class="list-group pl-3 pb-3">
                        @foreach ($teacher->bctSubjects as $subject)
                        <ul class="list-group">
                            {{-- DISPLAYS SUBJECTS A TEACHER IS PREMITED TO TEACH OR MODIFY ATTENDENCE OF. --}}
                            <a href="/teachers/attendancedashboard/<?=$subject->bctAuthorizedSubjects->batch?>/<?=$subject->subject_code?>">
                                <span class="pl-2 ">
                                    <li class="list-group-item disabled" dusk="sub" id="<?=$subject->subject_code ?>"> {{$subject->bctAuthorizedSubjects->batch}}th batch <span class="py-2 px-2">{{$subject->name}}</span> </li>
                                </span>
                            </a>
                        </ul>

                        @endforeach
                    </ul>
                    @else
                    <h3>There are no subject's attendance assigned to you yet. Please visit the department for the necessary permission to edit the attendance of desired class.</h3>
                    @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
