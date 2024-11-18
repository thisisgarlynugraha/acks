@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'ACKS') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Management Data') }}</li>
        <li class="breadcrumb-item">{{ __('Attendance') }}</li>
        <li class="breadcrumb-item">
            <a href="{{ route('attendance.show', $data->id) }}">{{ __('Detailed Data') }}</a>
        </li>
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
                        <a href="{{ route('attendance.index') }}" class="btn btn-warning float-right mr-2">
                            <span class="fas fa-arrow-left"></span> {{ __('Back') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudAttendance" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Date') }}</th>
                                    <th class="text-center">{{ __('Time') }}</th>
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
        var datatable = $('#crudAttendance').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('attendance.data-show', Crypt::encrypt($data->id)) }}",
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'date', name: 'date'},
                { data: 'time', name: 'time', width: '30%', class: 'text-center' },
            ]
        })
    </script>
@endpush