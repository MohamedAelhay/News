@extends('app')
@section('title', 'Folders')
@section('styles')
    <link rel="stylesheet" href={{asset("css/plugins/dataTables/datatables.min.css")}}>
@endsection
@section('content')
<div id="wrapper">
    @component('components/main')@endcomponent
    <div id="page-wrapper" class="gray-bg">
        @component('components/navbar')@endcomponent
        <div class="row wrapper border-bottom white-bg page-heading">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-lg-10">
                <h2>Folders</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href={{route('home')}}>Home</a>
                    </li>
                    <li class="active">
                        <strong>Folder</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Folders</h5>

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href={{route('folders.create')}}>Create New Folder</a></li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($folders as $folder)
                                            @can($folder->name)
                                                <tr class="gradeA">
                                                    <td>{{$folder->name}}</td>
                                                    <td>{{$folder->description}}</td>
                                                    <td class="center">
                                                        <div class="btn-group">
                                                            <a class="btn-white btn btn-xs" href={{route('folders.show', $folder->id)}}>View</a>
                                                            <a class="btn-white btn btn-xs" href={{route('folders.edit', $folder->id)}}>Edit</a>
                                                            <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('folders.destroy', $folder->id)}}>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn-white btn btn-xs">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endcan
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
    <script src={{asset("js/plugins/dataTables/datatables.min.js")}}></script>

    <!-- Custom and plugin javascript -->
<script src={{ asset("js/inspinia.js")}}></script>
<script src={{ asset("js/plugins/pace/pace.min.js")}}></script>
@endsection
