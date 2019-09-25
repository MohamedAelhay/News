@extends('app')
@section('title', 'Staff Table')
@section('styles')
    <!-- FooTable -->
    <link href={{ asset("css/plugins/footable/footable.core.css")}} rel="stylesheet">
@endsection
@section('content')
<div id="wrapper">

    @component('components/main')
    @endcomponent

    <div id="page-wrapper" class="gray-bg">
        @component('components/navbar')
        @endcomponent
        <div class="row wrapper border-bottom white-bg page-heading">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-lg-10">
                <h2>Staff</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href={{route('home')}}>Home</a>
                    </li>
                    <li class="active">
                        <strong>Staff</strong>
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
                                    <li><a href={{route('staff.create')}}>Create New Job</a>
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
                                    <th>Job</th>
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
                                @foreach($staff as $member)
                                    <tr>
                                        <td>{{$member->user->fname}}</td>
                                        <td>{{$member->user->lname}}</td>
                                        <td>{{$member->user->email}}</td>
                                        <td>{{$member->job->name}}</td>
                                        <td>
                                            @if($member->is_active)
                                                <span class="label label-primary">Active</span>
                                            @else
                                                <span class="label label-default">Unactive</span>
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            <div class="btn-group">
                                                <a class="btn-white btn btn-xs" href={{route('staff.show', $member->id)}}>View</a>
                                                <a class="btn-white btn btn-xs" href={{route('staff.edit', $member->id)}}>Edit</a>
                                                <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('staff.destroy', $member->id)}}>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn-white btn btn-xs">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>{{$member->user->phone}}</td>
                                        <td>{{$member->gender}}</td>
                                        <td>{{$member->city->name}}</td>
                                        <td>{{$member->country->name}}</td>
                                        <td><img src="{{ Storage::url($member->images->image)}}"
                                                             alt="No Image" class="img-thumbnail" height="50px" width="100px"></td>
                                    </tr>
                                @endforeach
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
<!-- FooTable -->
<script src={{ asset("js/plugins/footable/footable.all.min.js")}}></script>

<!-- Custom and plugin javascript -->
<script src={{ asset("js/inspinia.js")}}></script>
<script src={{ asset("js/plugins/pace/pace.min.js")}}></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });

</script>
@endsection
