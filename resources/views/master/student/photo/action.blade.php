<div class="d-flex">
    @can('Student Photo - Delete')
        <a href="{{ route('student.photo.destroy', Crypt::encrypt($id)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
            <span class="fas fa-trash"></span>
        </a>
    @endcan
</div>