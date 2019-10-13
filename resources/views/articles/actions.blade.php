<div class="btn-group">
    <a class="btn-white btn btn-xs" href={{route('articles.show', $article->id)}}>View</a>
    <a class="btn-white btn btn-xs" href={{route('articles.edit', $article->id)}}>Edit</a>
    <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('articles.destroy', $article->id)}}>
        @csrf
        @method('DELETE')
        <button class="btn-white btn btn-xs">Delete</button>
    </form>
</div>
