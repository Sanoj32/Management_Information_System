@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Permissions</div>

                <div class="card-body">
                    <ul class="list-group">
                        {{$teacher->name}}
                    </ul>
                    <h2>Permissions</h2>
                    {{-- LIST THE PERMISSIONS OF A TEACHER HERE. --}}
                    <a href="/admin/teachers/<?=$teacher->teacher_code?>/edit"><button class="btn btn-dark"> Edit permissions </button> </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
