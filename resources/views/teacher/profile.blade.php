@extends('layouts.app')

@section('content')
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
                        <span class="pl-2 ">
                            <li>{{$subject->name}}</li>
                        </span>
                        @endforeach
                    </ul>

                    {{-- LIST THE PERMISSIONS OF A TEACHER HERE. --}}
                    <a href="/admin/teachers/<?=$teacher->teacher_code?>/edit"><button class="btn btn-dark"> Edit permissions </button> </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
