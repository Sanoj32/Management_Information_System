@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Closed Attendances</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($uniqueBatches as $batch )
                        <a href="/admin/closed/attendance/<?=$batch?>">
                            <li class=" list-group-item disabled">{{$batch}} th batch</li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
