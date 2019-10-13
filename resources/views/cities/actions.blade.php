<div class="btn-group">
    {{--@can('show role')--}}
    <a class="btn-white btn btn-xs" href={{route('cities.show', $city->id)}}>View</a>
    {{--@can('edit role')--}}
    <a class="btn-white btn btn-xs" href={{route('cities.edit', $city->id)}}>Edit</a>
    {{--@can('delete role')--}}
    <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('cities.destroy', $city->id)}}>
        @csrf
        @method('DELETE')
        <button class="btn-white btn btn-xs">Delete</button>
    </form>
    {{--@endcan--}}
    {{--@endcan--}}
    {{--@endcan--}}
</div>
