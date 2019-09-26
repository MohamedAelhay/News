@extends('app')
@section('title', 'Edit Member')
@section('styles')
    @component('components.create&edit.style')@endcomponent

    <link href={{asset("css/plugins/jasny/jasny-bootstrap.min.css")}} rel="stylesheet">
    <link href={{asset("css/plugins/codemirror/codemirror.css")}} rel="stylesheet">
@endsection
@section('content')
    <div id="wrapper">
    @component('components/main')@endcomponent
        <div id="page-wrapper" class="gray-bg">
        @component('components/navbar')@endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Member</h5>
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

                    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action={{route("staff.update", $staff->id)}}>
                        @csrf
                        @method('PUT')

                        <div class="row" style="padding: 20px">
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">First Name</label>
                                <input type="text" name="fname" class="col-sm-8" value="{{ $staff->user->fname }}"placeholder="First Name" required="">
                                @component('components.error', ['errorName'=>'fname'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Last Name</label>
                                <input type="text" name="lname" class="col-sm-8" value="{{ $staff->user->lname }}"placeholder="Last Name" required="">
                                @component('components.error', ['errorName'=>'lname'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">E-mail</label>
                                <input type="text" name="email" class="col-sm-8" value="{{ $staff->user->email }}"placeholder="E-mail" required="">
                                @component('components.error', ['errorName'=>'email'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Phone</label>
                                <input type="text" name="phone" class="col-sm-8" value="{{ $staff->user->phone }}"placeholder="Phone" required="">
                                @component('components.error', ['errorName'=>'phone'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Gender<br/><small class="text-navy">List</small></label>
                                <select name="gender" class="col-sm-8">
                                    <option value="{{ $staff->gender }}">{{ $staff->gender }}</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                @component('components.error', ['errorName'=>'gender'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Job<br/><small class="text-navy">List</small></label>
                                <select name="work_id" class="col-sm-8">
                                    <option value="{{ $staff->job->id }}">{{$staff->job->name}}</option>
                                    @foreach($works as $work)
                                        <option value={{$work->id}}>{{$work->name}}</option>
                                    @endforeach
                                </select>
                                @component('components.error', ['errorName'=>'work_id'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Countries<br/><small class="text-navy">List</small></label>
                                <select name="country_id" class="col-sm-8" id="country">
                                    <option value="{{ $staff->country->id }}">{{ $staff->country->name  }}</option>
                                    @foreach($countries as $country)
                                        <option value={{$country->id}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @component('components.error', ['errorName'=>'country_id'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Cities<br/><small class="text-navy">List</small></label>
                                <select name="city_id" class="col-sm-8" id="city">
                                    <option value="{{ $staff->city->id }}">{{ $staff->city->name }}</option>
                                    {{-- Ajax Script --}}
                                </select>
                                @component('components.error', ['errorName'=>'city_id'])@endcomponent
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
                            @component('components.error', ['errorName'=>'image'])@endcomponent
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a class="btn btn-white" href="{{ URL::previous() }}">Cancel</a>
                                <button class="btn btn-primary" type="submit">Update</button>
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
    @component('components.create&edit.cityAjax', ['url' => 'citiesByCountry']) @endcomponent
@endsection
