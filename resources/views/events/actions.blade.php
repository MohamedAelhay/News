<div class="btn-group">
    <a class="btn-white btn btn-xs" href={{route('events.show', $event->id)}}>View</a>
    <a class="btn-white btn btn-xs" href={{route('events.edit', $event->id)}}>Edit</a>
    <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('events.destroy', $event->id)}}>
        @csrf
        @method('DELETE')
        <button class="btn-white btn btn-xs">Delete</button>
    </form>
</div>
