@extends('layouts.app')

@section('content')
{{-- This view is responsible for showing the permission edit view to the admin exclusively.
From here admin can grant and revoke permissions to teachers for editing attendance --}}


<div class="container">
    <div id='app'>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <h2>Grant or revoke permission to edit attendance for <div class="font-weight-bold">" {{$teacher->name}} " for {{$batch}}th batch <div>
                </h2>
                <hr>
                <h3> First Semester</h3>
                <ul class="list-group p\b-3 pt-1">
                    @foreach ($first as $one)
                    <li class="list-group-item">
                        <span>
                            <h5 class="display-inline center pt-2">{{$one->name}}</h5>
                            <?php
                                //check if a connection exists for a particular batch
                                $connection = false;
                                $exists = DB::table('bct_authorized_subjects')
                                ->where('subject_code',$one->subject_code)
                                ->where('teacher_code',$teacher_code)
                                ->where('batch',$batch);
                                if($exists->count() == 1){
                                    $connection = true;
                                }
                             ?>
                            <grant-button batch="<?=$batch?>" connection="<?= $connection?>" teacher-code="<?= $teacher_code ?>" subject-code="<?= $one->subject_code ?>"> </grant-button>
                        </span>
                    </li>
                    @endforeach
                </ul>
                <h3> Second Semester</h3>


                <ul class="list-group">
                    @foreach ($second as $two)
                    <li class="list-group-item display-inline">
                        <span>
                            <h5 class="display-inline center pt-2">{{$two->name}}</h5>
                            <?php
                                //check if a connection exists for a particular batch
                                $connection = false;
                                $exists = DB::table('bct_authorized_subjects')
                                ->where('subject_code',$two->subject_code)
                                ->where('teacher_code',$teacher_code)
                                ->where('batch',$batch);
                                if($exists->count() == 1){
                                    $connection = true;
                                }
                             ?>

                            <grant-button batch="<?=$batch?>" connection="<?= $connection?>" teacher-code="<?= $teacher_code ?>" subject-code="<?= $two->subject_code ?>"> </grant-button>
                        </span>

                    </li>
                    @endforeach
                </ul>

                <h3 class="pt-3"> Third Semester</h3>
                <ul class=" list-group pb-3 pt-1">
                    @foreach ($third as $three)
                    <li class="list-group-item">
                        <span>
                            <h5 class="display-inline center pt-2">{{$three->name}}</h5>
                            <?php
                                //check if a connection exists for a particular batch
                                $connection = false;
                                $exists = DB::table('bct_authorized_subjects')
                                ->where('subject_code',$three->subject_code)
                                ->where('teacher_code',$teacher_code)
                                ->where('batch',$batch);
                                if($exists->count() == 1){
                                    $connection = true;
                                }
                             ?>

                            <grant-button batch="<?=$batch?>" connection="<?= $connection?>" teacher-code="<?= $teacher_code ?>" subject-code="<?= $three->subject_code ?>"> </grant-button>
                        </span>


                    </li>
                    @endforeach
                </ul>
                <h3> Fourth Semester</h3>
                <ul class="list-group pb-3 pt-1">
                    @foreach ($fourth as $four)
                    <li class="list-group-item">
                        <span>
                            <h5 class="display-inline center pt-2">{{$four->name}}</h5>
                            <?php
                                //check if a connection exists for a particular batch
                                $connection = false;
                                $exists = DB::table('bct_authorized_subjects')
                                ->where('subject_code',$four->subject_code)
                                ->where('teacher_code',$teacher_code)
                                ->where('batch',$batch);
                                if($exists->count() == 1){
                                    $connection = true;
                                }
                             ?>

                            <grant-button batch="<?=$batch?>" connection="<?= $connection?>" teacher-code="<?= $teacher_code ?>" subject-code="<?= $four->subject_code ?>"> </grant-button>
                        </span>

                    </li>
                    @endforeach
                </ul>
                <h3> Fifth Semester</h3>
                <ul class="list-group pb-3 pt-1">
                    @foreach ($fifth as $five)

                    <li class="list-group-item">
                        <span>
                            <h5 class="display-inline center pt-2">{{$five->name}}</h5>
                            <?php
                                //check if a connection exists for a particular batch
                                $connection = false;
                                $exists = DB::table('bct_authorized_subjects')
                                ->where('subject_code',$five->subject_code)
                                ->where('teacher_code',$teacher_code)
                                ->where('batch',$batch);
                                if($exists->count() == 1){
                                    $connection = true;
                                }
                             ?>

                            <grant-button batch="<?=$batch?>" connection="<?= $connection?>" teacher-code="<?= $teacher_code ?>" subject-code="<?= $five->subject_code ?>"> </grant-button>
                        </span>
                    </li>
                    @endforeach
                </ul>
                <h3> Sixth Semester</h3>
                <ul class="list-group pb-3 pt-1">
                    @foreach ($sixth as $six)

                    <li class="list-group-item">
                        <span>
                            <h5 class="display-inline center pt-2">{{$six->name}}</h5>
                            <?php
                                //check if a connection exists for a particular batch
                                $connection = false;
                                $exists = DB::table('bct_authorized_subjects')
                                ->where('subject_code',$six->subject_code)
                                ->where('teacher_code',$teacher_code)
                                ->where('batch',$batch);
                                if($exists->count() == 1){
                                    $connection = true;
                                }
                             ?>

                            <grant-button batch="<?=$batch?>" connection="<?= $connection?>" teacher-code="<?= $teacher_code ?>" subject-code="<?= $six->subject_code ?>"> </grant-button>
                        </span>
                    </li>
                    @endforeach
                </ul>
                <h3> Seventh Semester</h3>
                <ul class="list-group pb-3 pt-1">
                    @foreach ($seventh as $seven)
                    <li class="list-group-item">
                        <span>
                            <h5 class="display-inline center pt-2">{{$seven->name}}</h5>
                            <?php
                                //check if a connection exists for a particular batch
                                $connection = false;
                                $exists = DB::table('bct_authorized_subjects')
                                ->where('subject_code',$seven->subject_code)
                                ->where('teacher_code',$teacher_code)
                                ->where('batch',$batch);
                                if($exists->count() == 1){
                                    $connection = true;
                                }
                             ?>

                            <grant-button batch="<?=$batch?>" connection="<?= $connection?>" teacher-code="<?= $teacher_code ?>" subject-code="<?= $seven->subject_code ?>"> </grant-button>
                        </span>
                    </li>
                    @endforeach
                </ul>
                <h3> Eighth Semester</h3>
                <ul class="list-group pb-3 pt-1">
                    @foreach ($eighth as $eight)
                    <li class="list-group-item">
                        <span>
                            <h5 class="display-inline center pt-2">{{$eight->name}}</h5>
                            <?php
                                //check if a connection exists for a particular batch
                                $connection = false;
                                $exists = DB::table('bct_authorized_subjects')
                                ->where('subject_code',$eight->subject_code)
                                ->where('teacher_code',$teacher_code)
                                ->where('batch',$batch);
                                if($exists->count() == 1){
                                    $connection = true;
                                }
                             ?>

                            <grant-button batch="<?=$batch?>" connection="<?= $connection?>" teacher-code="<?= $teacher_code ?>" subject-code="<?= $eight->subject_code ?>"> </grant-button>
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
