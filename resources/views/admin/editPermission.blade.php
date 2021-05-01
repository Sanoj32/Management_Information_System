@extends('layouts.app')

@section('content')
{{-- This view is responsible for showing the permission edit view to the admin exclusively.
From here admin can grant and revoke permissions to teachers for editing attendance --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h2>Grant or revoke permission to edit attendance for teachers</h2>
            <h3> First Semester</h3>
            <ul class="list-group pb-3 pt-1">
                @foreach ($first as $fir)
                <li class="list-group-item">
                    <span>
                        <h5>{{$fir->name}}
                            <form method="POST" action="/admin/teachers/<?=$teacher_code?>/edit/<?=$fir->subject_code?>">
                                @csrf
                                <button class="btn btn-success float-right" type="submit">A view component</button>
                            </form>
                        </h5>
                    </span>
                </li>
                @endforeach
            </ul>
            <h3> Second Semester</h3>
            <ul class="list-group pb-3 pt-1">
                @foreach ($second as $sec)
                <li class="list-group-item">
                    <h5>{{$sec->name}}</h5>
                </li>
                @endforeach
            </ul>
            <h3> Third Semester</h3>
            <ul class="list-group pb-3 pt-1">
                @foreach ($third as $thi)
                <li class="list-group-item">
                    <h5>{{$thi->name}}</h5>
                </li>
                @endforeach
            </ul>
            <h3> Fourth Semester</h3>
            <ul class="list-group pb-3 pt-1">
                @foreach ($fourth as $fou)
                <li class="list-group-item">
                    <h5>{{$fou->name}}</h5>
                </li>
                @endforeach
            </ul>
            <h3> Fifth Semester</h3>
            <ul class="list-group pb-3 pt-1">
                @foreach ($fifth as $fif)
                <li class="list-group-item">
                    <h5>{{$fif->name}}</h5>
                </li>
                @endforeach
            </ul>
            <h3> Sixth Semester</h3>
            <ul class="list-group pb-3 pt-1">
                @foreach ($sixth as $six)
                <li class="list-group-item">
                    <h5>{{$six->name}}</h5>
                </li>
                @endforeach
            </ul>
            <h3> Seventh Semester</h3>
            <ul class="list-group pb-3 pt-1">
                @foreach ($seventh as $sev)
                <li class="list-group-item">
                    <h5>{{$sev->name}}</h5>
                </li>
                @endforeach
            </ul>
            <h3> Eighth Semester</h3>
            <ul class="list-group pb-3 pt-1">
                @foreach ($eighth as $eig)
                <li class="list-group-item">
                    <h5>{{$eig->name}}</h5>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
