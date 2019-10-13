@extends('app')
@section('title', 'Topic Details')
@section('styles')
    @component('components.index.style')@endcomponent
@endsection
@section('content')
    <div id="wrapper">

        @component('components/main')
        @endcomponent

        <div id="page-wrapper" class="gray-bg">
            @component('components/navbar')
            @endcomponent
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Visitor</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href={{route('home')}}>Home</a>
                        </li>
                        <li class="active">
                            <a href={{route('articles.index')}}>visitor</a>
                        </li>
                        <li class="active">
                            <strong>{{$article->main_title}}</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Topic</h5>

                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href={{route('articles.create')}}>Create New Job</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">

                                <table class="footable table table-stripped toggle-arrow-tiny">
                                    <thead>
                                    <tr>
                                        <th data-toggle="true">Main Title</th>
                                        <th>Second Title</th>
                                        <th>Publish</th>
                                        <th>Action</th>
                                        <th data-hide="all">Type</th>
                                        <th data-hide="all">Content</th>
                                        <th data-hide="all">Image</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$article->main_title}}</td>
                                            <td>{{$article->second_title}}</td>
                                            <td>
                                                @if($article->is_publish)
                                                    <span class="label label-primary status" id="{{$article->id}}">Publish</span>
                                                @else
                                                    <span class="label label-default status" id="{{$article->id}}">Un Publish</span>
                                                @endif
                                            </td>
                                            <td class="text-left">
                                                <div class="btn-group">
                                                    <a class="btn-white btn btn-xs" href={{route('articles.edit', $article->id)}}>Edit</a>
                                                    <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('articles.destroy', $article->id)}}>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn-white btn btn-xs">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>{{$article->type}}</td>
                                            <td>{{$article->content}}</td>
                                            <td>
                                                @foreach($article->images as $image)
                                                    <img src="{{ Storage::url($image->image)}}" alt="No Image" class="img-thumbnail" height="50px" width="100px">
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>
                                            <div class="dd" id="nestable">
                                                <ol class="dd-list">
                                                    @foreach($article->relatedTopics->take(10) as $topic)
                                                        <li class="dd-item" data-id="1">
                                                            <a class="dd-handle" href={{route('articles.show', $topic->topic->id)}}>{{ $loop->iteration }} - {{$topic->topic->main_title}}</a>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2017
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    @component('components.ajax.togglePublish')@endcomponent
    @component('components.index.scripts')@endcomponent
@endsection
