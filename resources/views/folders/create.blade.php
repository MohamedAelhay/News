@extends('app')
@section('title', 'Create Folder')
@section('styles')
    @component('components.create&edit.style')@endcomponent

    <link rel="stylesheet" href={{asset("css/plugins/jasny/jasny-bootstrap.min.css")}}>
    <link rel="stylesheet" href={{asset("css/plugins/codemirror/codemirror.css")}}>

    <link rel="stylesheet" href={{asset("css/plugins/select2/select2.min.css")}}>

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
                    <h5>Create New Folder</h5>

                </div>
                <div class="ibox-content">

                    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action={{route("folders.store")}}>
                        @csrf

                        <div class="row" style="padding: 20px">
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Main Title</label>
                                <input type="text" name="name" class="col-sm-8" value="{{ old('name') }}"placeholder="Folder Name" required="">
                                @component('components.error', ['errorName'=>'name'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Second Title</label>
                                <input type="text" name="description" class="col-sm-8" value="{{ old('description') }}"placeholder="Description" required="">
                                @component('components.error', ['errorName'=>'description'])@endcomponent
                            </div>
                            <div class="form-group col-sm-12 row"><label class="col-sm-2 control-label">Staff<br/><small class="text-navy">List</small></label>
                                <select class="select2_demo_2 col-sm-9" name="staff[]" multiple="multiple">
                                    @foreach($staff as $member)
                                        <option value="{{$member->user->id}}">{{$member->user->fname}}</option>
                                    @endforeach
                                </select>
                                @component('components.error', ['errorName'=>'staff[]'])@endcomponent
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>

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
    <!-- Select2 -->
    <script src={{asset("js/plugins/select2/select2.full.min.js")}}></script>
    <script>
        $(".select2_demo_2").select2({
            placeholder: "Select Staff Members",
            allowClear: true,
            maximumSelectionLength: 10
        });
    </script>
@endsection
