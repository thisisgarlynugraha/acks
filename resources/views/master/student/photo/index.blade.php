@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'ACKS') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Settings') }}</li>
        <li class="breadcrumb-item">{{ __('Account') }}</li>
        <li class="breadcrumb-item"><a href="{{ route('student.index') }}">{{ __('Student') }}</a></li>
        <li class="breadcrumb-item">{{ $data->name }}</li>
        <li class="breadcrumb-item">{{ __('Photo') }}</li>
        <li class="breadcrumb-item"><a href="{{ route('student.photo.index', $data->id) }}">{{ __('Data') }}</a></li>
    </ol>
@endsection

@section('section-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col">
                        <h4><b>{{ $title }}</b></h4>
                    </div>
                    <div class="col">
                        <a href="{{ route('student.photo.create', Crypt::encrypt($data->id)) }}" class="btn btn-primary float-right mr-2">
                            <span class="fas fa-plus"></span> {{ __('Upload') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudStudentPhoto" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Photo') }}</th>
                                    <th class="text-center">{{ __('Priority') }}</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var datatable = $('#crudStudentPhoto').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('student.photo.data', Crypt::encrypt($data->id)) }}",
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'url', name: 'url'},
                { data: 'is_featured', name: 'is_featured', width: '10%', class: 'text-center' },
                { data: 'action', name: 'action', orderable: true, searchable: true, width: '5%', class: 'text-center' }
            ]
        })
    </script>
@endpush