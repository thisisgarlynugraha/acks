<div class="d-flex">
    @can('Attendance - Show')
        <a href="{{ route('attendance.show', Crypt::encrypt($id)) }}" class="ml-2 btn btn-info">
            <span class="fas fa-eye"></span>
        </a>
    @endcan
</div>