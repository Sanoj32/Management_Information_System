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
