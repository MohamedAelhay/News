@extends('app')
@section('title', 'Create Role')
@section('styles')
    <!-- FooTable -->
    <link rel="stylesheet" href={{ asset("css/plugins/iCheck/custom.css")}}>
    <link rel="stylesheet" href={{ asset("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css")}}>

@endsection
@section('content')
    <div id="wrapper">
    @component('components/main')
    @endcomponent
        <div id="page-wrapper" class="gray-bg">
        @component('components/navbar')
        @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Create New Role</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
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
{{--                    @if ($errors->any())--}}
{{--                        {{ implode('', $errors->all('<div>:message</div>')) }}--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $message }}</strong>--}}
{{--                        </span>--}}
{{--                    @endif--}}
                    <form method="POST" role="form" class="form-horizontal" action={{route("roles.update", $role->id)}}>
                        @csrf
                        @method('PUT')
                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10"><input type="text" name="name" value="{{$role->name}}" class="form-control"></div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" value="{{$role->description}}" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Permissions<br/><small class="text-navy">List</small></label>
                            <div class="col-sm-10">
                                <div class="row">
                                @foreach($allPermissions as $permission)
                                @if(in_array($permission['name'], $rolePermissions->toArray()))
                                        <div class="i-checks col-sm-3"><label> <input type="checkbox" name="permissions[]" value={{$permission->id}} checked=""> <i></i> {{$permission->name}} </label></div>
                                    @else
                                        <div class="i-checks col-sm-3"><label> <input type="checkbox" name="permissions[]" value={{$permission->id}}> <i></i> {{$permission->name}} </label></div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a class="btn btn-white" href="{{ URL::previous() }}">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
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
    <!-- Custom and plugin javascript -->
    <script src={{ asset("js/inspinia.js")}}></script>
    <script src={{ asset("js/plugins/pace/pace.min.js")}}></script>

    <!-- iCheck -->
    <script src={{ asset("js/plugins/iCheck/icheck.min.js")}}></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection
