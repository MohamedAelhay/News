<div class="btn-group">
    <a class="btn-white btn btn-xs" href={{route('staff.show', $staff->id)}}>View</a>
    <a class="btn-white btn btn-xs" href={{route('staff.edit', $staff->id)}}>Edit</a>
    <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('staff.destroy', $staff->id)}}>
        @csrf
        @method('DELETE')
        <button class="btn-white btn btn-xs">Delete</button>
    </form>
</div>
