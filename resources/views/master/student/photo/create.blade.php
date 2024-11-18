@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'SMPN 2 Ciamis') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Manajemen Data') }}</li>
        <li class="breadcrumb-item"><a href="{{ route('student.index') }}">{{ __('Siswa') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('student.photo.index', Crypt::encrypt($data->id)) }}">{{ $data->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('student.photo.index', Crypt::encrypt($data->id)) }}">{{ __('Foto') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('student.photo.create', Crypt::encrypt($data->id)) }}">{{ __('Unggah') }}</a></li>
    </ol>
@endsection

@section('section-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4><b>{{ $title }}</b></h4>
                </div>
                <form action="{{ route('student.photo.store', Crypt::encrypt($data->id)) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('Foto*') }}</label>
                            <div class="col-sm-9">
                                <input multiple accept="image/*" value="{{ old('files') }}" type="file" id="files" name="files[]" class="form-control dropify">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('student.photo.index', Crypt::encrypt($data->id)) }}" class="btn btn-warning">{{ __('Back') }}</a>
                        <button type="reset" class="btn btn-danger">{{ __('Reset') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection