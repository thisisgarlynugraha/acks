<div class="d-flex">
    @can('Student Photo - Read')
        <a href="{{ route('student.photo.index', Crypt::encrypt($id)) }}" class="ml-2 btn btn-info">
            <span class="fas fa-camera"></span>
        </a>
    @endcan

    @can('Student - Edit')
        <a href="{{ route('student.edit', Crypt::encrypt($id)) }}" class="ml-2 btn btn-warning">
            <span class="fas fa-edit"></span>
        </a>
    @endcan

    @can('Student - Delete')
        <a href="{{ route('student.destroy', Crypt::encrypt($id)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
            <span class="fas fa-trash"></span>
        </a>
    @endcan
</div>