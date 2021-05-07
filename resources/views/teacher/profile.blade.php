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
                    <h2>Permissions</h2>

                </div>


                <div class="card-body pb-2">
                    <h3>{{$teacher->name}} can take attendance of the following subjects.</h3>
                    <ul class="list-group pl-3 pb-3">
                        @foreach ($authorizedSubjects as $subject)
                        <?php $subName = BctSubject::where('subject_code',$subject->subject_code)->pluck('name');
                        ?>
                        {{-- DISPLAYS SUBJECTS A TEACHER IS PREMITED TO TEACH OR MODIFY ATTENDENCE OF. --}}
                        <span class="pl-2 ">
                            <li> {{$subject->batch}}th batch <span class="py-2 px-2"> {{$subName[0]}}</span> </li>
                        </span>
                        @endforeach
                    </ul>

                    {{-- LIST THE PERMISSIONS OF A TEACHER HERE. --}}
                    <div class="py-2">
                        <span class="pr-2">74th batch</span> <a href="/admin/teachers/<?=$teacher->teacher_code?>/edit/74"><button class="btn btn-dark"> Edit permissions </button> </a>
                    </div>
                    <div class="py-2">
                        <span class="pr-2">75th batch</span> <a href="/admin/teachers/<?=$teacher->teacher_code?>/edit/75"><button class="btn btn-dark"> Edit permissions </button> </a>
                    </div>
                    <div class="py-2">
                        <span class="pr-2">76th batch</span> <a href="/admin/teachers/<?=$teacher->teacher_code?>/edit/76"><button class="btn btn-dark"> Edit permissions </button> </a>
                    </div>
                    <div class="py-2">
                        <span class="pr-2">77th batch</span> <a href="/admin/teachers/<?=$teacher->teacher_code?>/edit/77"><button class="btn btn-dark"> Edit permissions </button> </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
