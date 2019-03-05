@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Setting Screen</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Please select screen</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-sm" name="display">
                                    @foreach($displays as $display)
                                        <option value="{{ $display->id }}">{{ $display->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Background Input</label>
                            <input type="file" class="form-control-file" id="bgimage" name="bgimage">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Signage 1 Input</label>
                            <input type="file" class="form-control-file" id="signage1" name="signage1">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Signage 2 Input</label>
                            <input type="file" class="form-control-file" id="signage2" name="signage2">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Video 1 Input</label>
                            <input type="file" class="form-control-file" id="video1" name="video1">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Video 2 Input</label>
                            <input type="file" class="form-control-file" id="video2" name="video2">
                        </div>

                        <button type="submit" class="btn btn-primary">Add slide</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection