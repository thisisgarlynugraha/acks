<div class="d-flex">
    <a href="{{ route('student.photo.index', Crypt::encrypt($id)) }}" class="ml-2 btn btn-info">
        <span class="fas fa-camera"></span>
    </a>

    <a href="{{ route('student.edit', Crypt::encrypt($id)) }}" class="ml-2 btn btn-warning">
        <span class="fas fa-edit"></span>
    </a>

    <a href="{{ route('student.destroy', Crypt::encrypt($id)) }}" class="ml-2 btn btn-danger" data-confirm-delete="true">
        <span class="fas fa-trash"></span>
    </a>
</div>