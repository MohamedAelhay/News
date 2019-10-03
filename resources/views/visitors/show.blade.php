@extends('app')
@section('title', 'Member Details')
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
                            <a href={{route('visitors.index')}}>visitor</a>
                        </li>
                        <li class="active">
                            <strong>{{$visitor->user->fname}}</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>All Jobs Index</h5>

                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href={{route('visitors.create')}}>Create New Job</a>
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
                                        <th data-toggle="true">First Name</th>
                                        <th>Last Name</th>
                                        <th>E-mail</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                        <th data-hide="all">Phone</th>
                                        <th data-hide="all">Gender</th>
                                        <th data-hide="all">City</th>
                                        <th data-hide="all">Country</th>
                                        <th data-hide="all">Image</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$visitor->user->fname}}</td>
                                            <td>{{$visitor->user->lname}}</td>
                                            <td>{{$visitor->user->email}}</td>
                                            <td>
                                                @if($visitor->is_active)
                                                    <span class="label label-primary status" id="{{$visitor->id}}">Active</span>
                                                @else
                                                    <span class="label label-default status" id="{{$visitor->id}}">Unactive</span>
                                                @endif
                                            </td>
                                            <td class="text-left">
                                                <div class="btn-group">
                                                    <a class="btn-white btn btn-xs" href={{route('visitors.edit', $visitor->id)}}>Edit</a>
                                                    <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('visitors.destroy', $visitor->id)}}>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn-white btn btn-xs">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>{{$visitor->user->phone}}</td>
                                            <td>{{$visitor->gender}}</td>
                                            <td>{{$visitor->city->name}}</td>
                                            <td>{{$visitor->country->name}}</td>
                                            <td><img src="{{ Storage::url($visitor->images[0]->image)}}"
                                                     alt="No Image" class="img-thumbnail" height="50px" width="100px"></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination pull-right"></ul>
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
    @component('components.ajax.toggleStatus')@endcomponent
    @component('components.index.scripts')@endcomponent
@endsection
