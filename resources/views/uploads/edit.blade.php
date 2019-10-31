@extends('app')
@section('title', 'Upload')
@section('styles')
    @component('components.create&edit.style')@endcomponent

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
                            <h5>Upload</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <form method="POST" enctype="multipart/form-data" class="form-horizontal" action={{route("upload.update", ['folder'=>$folder, 'upload'=>$upload])}}>
                                @csrf
                                @method('PUT')

                                <div class="row" style="padding: 20px">
                                    <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Name</label>
                                        <input type="text" name="name" class="col-sm-8" value="{{ $upload->name }}"placeholder="Name" required="">
                                        @component('components.error', ['errorName'=>'name'])@endcomponent
                                    </div>
                                    <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Description</label>
                                        <input type="text" name="description" class="col-sm-8" value="{{ $upload->description }}"placeholder="Description" required="">
                                        @component('components.error', ['errorName'=>'description'])@endcomponent
                                    </div>
                                    <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Type<br/><small class="text-navy">List</small></label>
                                        <select name="type" class="col-sm-8">
                                            <option value="{{ $upload->type }}">{{ $upload->type }}</option>
                                            <option value="image">Image</option>
                                            <option value="video">Video</option>
                                            <option value="document">Document</option>
                                        </select>
                                        @component('components.error', ['errorName'=>'type'])@endcomponent
                                    </div>
                                </div>
                                <div class="fileinput fileinput-new col-sm-offset-4 row" data-provides="fileinput">
                                    <label class="col-sm-4 control-label" style="margin-top:-12px">Upload<br/><small class="text-navy">File</small></label>
                                    <div class="col-sm-8">
                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span>
                                <span class="fileinput-exists">Change</span><input type="file" name="path"/></span>
                                        <span class="fileinput-filename"></span>
                                        <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                    </div>
                                    @component('components.error', ['errorName'=>'path'])@endcomponent
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
    <script src={{asset("js/plugins/jasny/jasny-bootstrap.min.js")}}></script>
@endsection
