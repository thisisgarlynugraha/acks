<div class="d-flex">
    @can('Health Monitoring - Show')
        <a href="{{ route('health-monitoring.show', Crypt::encrypt($id)) }}" class="ml-2 btn btn-info">
            <span class="fas fa-eye"></span>
        </a>
    @endcan
</div>