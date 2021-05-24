@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Active Attendances</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($uniqueBatches as $batch )
                        <h2 class="py-3">{{$batch}}th batch</h2>
                        @foreach ($activeAttendances as $activeAttendance )
                        @if($activeAttendance->batch == $batch)
                        <a href="#">
                            <li class="list-group-item disabled"> {{$activeAttendance->name}}</li>
                        </a>
                        @endif
                        @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
