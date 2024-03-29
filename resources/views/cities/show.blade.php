@extends('app')
@section('title', 'City Details')
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
                    <h2>Roles</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href={{route('home')}}>Home</a>
                        </li>
                        <li class="active">
                            <a href={{route('cities.index')}}>Cities</a>
                        </li>
                        <li class="active">
                            <strong>{{$city['name']}}</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>All Roles Index</h5>

                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href={{route('cities.create')}}>Create New City</a>
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
                                        <th data-toggle="true">Name</th>
                                        <th data-hide="all">Country</th>
                                        <th data-hide="all">Last Update</th>
                                        <th data-hide="all">Created at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$city['name']}}</td>
                                            <td>{{$city['country']->name}}</td>
                                            <td>{{$city['updated_at']}}</td>
                                            <td>{{$city['created_at']}}</td>
                                            <td class="text-left">
                                                <div class="btn-group">
                                                    @can('edit city')
                                                <a class="btn-white btn btn-xs" href={{route('cities.edit', $city['id'])}}>Edit</a>
                                                        @can('delete city')
                                                <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('cities.destroy', $city['id'])}}>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </form>
                                                        @endcan
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
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
    @component('components.index.scripts')@endcomponent
@endsection
