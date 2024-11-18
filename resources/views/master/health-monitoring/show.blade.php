@extends('layouts.master')

@section('title')
    <title>{{ config('app.name', 'ACKS') }} | {{ $title }}</title>
@endsection

@section('section-head')
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item">{{ __('Management Data') }}</li>
        <li class="breadcrumb-item">{{ __('Health Monitoring') }}</li>
        <li class="breadcrumb-item"><a href="{{ route('health-monitoring.show', $data->id) }}">{{ __('Detailed Data') }}</a></li>
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
                        <a href="{{ route('health-monitoring.index') }}" class="btn btn-warning float-right mr-2">
                            <span class="fas fa-arrow-left"></span> {{ __('Back') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudHealthMonitoring" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('No') }}</th>
                                    <th class="text-center">{{ __('Check Date') }}</th>
                                    <th class="text-center">{{ __('Weight') }}</th>
                                    <th class="text-center">{{ __('Height') }}</th>
                                    <th class="text-center">{{ __('Temperature') }}</th>
                                    <th class="text-center">{{ __('SPO2') }}</th>
                                    <th class="text-center">{{ __('Heart Rate') }}</th>
                                    <th class="text-center">{{ __('Stress Level') }}</th>
                                    <th class="text-center">{{ __('IMT') }}</th>
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
        var datatable = $('#crudHealthMonitoring').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('health-monitoring.data-show', Crypt::encrypt($data->id)) }}",
            columns: [
                { data: 'no', name: 'no', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                }, width: '5%', class: 'text-center' },
                { data: 'check_date', name: 'check_date'},
                { data: 'weight', name: 'weight', width: '10%', class: 'text-center' },
                { data: 'height', name: 'height', width: '10%', class: 'text-center' },
                { data: 'temperature', name: 'temperature', width: '10%', class: 'text-center' },
                { data: 'spo2', name: 'spo2', width: '10%', class: 'text-center' },
                { data: 'heart_rate', name: 'heart_rate', width: '10%', class: 'text-center' },
                { data: 'stress_level', name: 'stress_level', width: '10%', class: 'text-center' },
                { data: 'imt', name: 'imt', width: '10%', class: 'text-center' },
            ]
        })
    </script>
@endpush