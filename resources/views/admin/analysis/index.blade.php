@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Select a student.</div>

                <div class="card-body">
                    <form method="POST" action="/admin/analysis/student">
                        @csrf

                        <div class="form-group row">
                            <label for="batch" class="col-md-4 col-form-label text-md-right">Batch</label>

                            <div class="col-md-6">
                                <input id="batch" type="text" placeholder="74" class="form-control @error('batch') is-invalid @enderror" name="batch" value="{{ old('batch') }}" required autofocus>

                                @error('batch')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="roll" class="col-md-4 col-form-label text-md-right">Roll number</label>

                            <div class="col-md-6">
                                <input id="roll" type="text" placeholder="23" class="form-control @error('roll') is-invalid @enderror" name="roll" value="{{ old('roll') }}" required autocomplete="roll" autofocus>

                                @error('roll')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Find
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
