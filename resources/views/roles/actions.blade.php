<div class="btn-group">
    <a class="btn-white btn btn-xs" href={{route('roles.show', $role->id)}}>View</a>
    <a class="btn-white btn btn-xs" href={{route('roles.edit', $role->id)}}>Edit</a>
    <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('roles.destroy', $role->id)}}>
        @csrf
        @method('DELETE')
        <button class="btn-white btn btn-xs">Delete</button>
    </form>
</div>
