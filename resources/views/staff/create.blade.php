@extends('app')
@section('title', 'Create Job')
@section('styles')
    <!-- FooTable -->
    <link rel="stylesheet" href={{ asset("css/plugins/iCheck/custom.css")}}>
    <link rel="stylesheet" href={{ asset("css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css")}}>

    <link href={{asset("css/plugins/jasny/jasny-bootstrap.min.css")}} rel="stylesheet">
    <link href={{asset("css/plugins/codemirror/codemirror.css")}} rel="stylesheet">
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
                    <h5>Create New Job</h5>
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
                    @if ($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action={{route("staff.store")}}>
                        @csrf

                        <div class="row" style="padding: 20px">
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">First Name</label>
                                <input type="text" name="fname" class="col-sm-8" value="{{ old('fname') }}"placeholder="First Name" required="">
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Last Name</label>
                                <input type="text" name="lname" class="col-sm-8" value="{{ old('lname') }}"placeholder="Last Name" required="">
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">E-mail</label>
                                <input type="text" name="email" class="col-sm-8" value="{{ old('email') }}"placeholder="E-mail" required="">
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Phone</label>
                                <input type="text" name="phone" class="col-sm-8" value="{{ old('phone') }}"placeholder="Phone" required="">
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Gender<br/><small class="text-navy">List</small></label>
                                <select name="gender" class="col-sm-8">
                                    <option value="{{ old('gender') }}">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Job<br/><small class="text-navy">List</small></label>
                                <select name="work_id" class="col-sm-8">
                                    <option value="{{ old('work_id') }}">Select Job</option>
                                    @foreach($works as $work)
                                        <option value={{$work->id}}>{{$work->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Countries<br/><small class="text-navy">List</small></label>
                                <select name="country_id" class="col-sm-8" id="country">
                                    <option value="{{ old('country_id') }}">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value={{$country->id}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Cities<br/><small class="text-navy">List</small></label>
                                <select name="city_id" class="col-sm-8" id="city">
                                    <option value="">Select City</option>
                                    {{-- Script --}}
                                </select>
                            </div>
                        </div>
                        <div class="fileinput fileinput-new col-sm-offset-4 row" data-provides="fileinput">
                            <label class="col-sm-4 control-label" style="margin-top:-12px">Image<br/><small class="text-navy">File</small></label>
                            <div class="col-sm-8">
                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span><input type="file" name="image"/></span>
                                <span class="fileinput-filename"></span>
                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a class="btn btn-white" href="{{ URL::previous() }}">Cancel</a>
                                <button class="btn btn-primary" type="submit">Create</button>
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
            $('#country').change(function () {
                let country_id = $(this).val();
                $.ajax({
                    type:'GET',
                    url: 'http://localhost:8000/citiesByCountry/' + country_id,
                    success:function(cities){
                        $('#city').empty()
                        if(Object.keys(cities).length != 0)
                            {
                                $('#city').append("<option value=''>Select City</option>")
                                $.each(cities, function(name, id){
                                $('#city').append("<option value=" + id + ">" + name +"</option>")
                                });
                            }
                        else
                        {
                            $('#city').append("<option value=''>No City</option>")
                        }
                    },
                    error:function () {
                        alert("You Should Select Country");
                    }
                })
            });
        });
    </script>

    <!-- Jasny For File Upload-->
    <script src={{asset("js/plugins/jasny/jasny-bootstrap.min.js")}}></script>

@endsection
