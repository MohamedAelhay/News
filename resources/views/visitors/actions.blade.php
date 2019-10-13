<div class="btn-group">
    <a class="btn-white btn btn-xs" href={{route('visitors.show', $visitor->id)}}>View</a>
    <a class="btn-white btn btn-xs" href={{route('visitors.edit', $visitor->id)}}>Edit</a>
    <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('visitors.destroy', $visitor->id)}}>
        @csrf
        @method('DELETE')
        <button class="btn-white btn btn-xs">Delete</button>
    </form>
</div>
