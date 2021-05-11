@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Teachers</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <ul class="list-group">
                        @foreach ($teachers as $teacher )
                        <?php $teacher_code = $teacher->teacher_code ;?>
                        <a href="/admin/teachers/<?=$teacher_code?>">
                            <li class="list-group-item disabled">{{$teacher->name}}</li>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
