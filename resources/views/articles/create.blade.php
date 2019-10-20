@extends('app')
@section('title', 'Create Topic')
@section('styles')
    @component('components.create&edit.style')@endcomponent

    <link rel="stylesheet" href={{asset("css/plugins/dropzone/basic.css")}}>
    <link rel="stylesheet" href={{asset("css/plugins/dropzone/dropzone.css")}}>

    <link rel="stylesheet" href={{asset("css/plugins/jasny/jasny-bootstrap.min.css")}}>
    <link rel="stylesheet" href={{asset("css/plugins/codemirror/codemirror.css")}}>

    <link rel="stylesheet" href={{asset("css/plugins/select2/select2.min.css")}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css"/>

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
                    <h5>Create New Topic</h5>

                </div>
                <div class="ibox-content">

                    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action={{route("articles.store")}}>
                        @csrf

                        <div class="row" style="padding: 20px">
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Main Title</label>
                                <input type="text" name="main_title" class="col-sm-8" value="{{ old('main_title') }}"placeholder="Main Title" required="">
                                @component('components.error', ['errorName'=>'main_title'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Second Title</label>
                                <input type="text" name="second_title" class="col-sm-8" value="{{ old('second_title') }}"placeholder="Second Title" required="">
                                @component('components.error', ['errorName'=>'second_title'])@endcomponent
                            </div>

                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Type<br/><small class="text-navy">List</small></label>
                                <select name="type" class="col-sm-8" id="articleType">
                                    <option value="" disabled>Select Type</option>
                                    <option value=1>Article</option>
                                    <option value=2>News</option>
                                </select>
                                @component('components.error', ['errorName'=>'type'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">User<br/><small class="text-navy">List</small></label>
                                <select name="user_id" class="col-sm-8" id="userType">
                                    <option value="">Select User</option>
                                    {{-- Script --}}
                                </select>
                                @component('components.error', ['errorName'=>'user_id'])@endcomponent
                            </div>
                            <div class="form-group col-sm-12 row"><label class="col-sm-2 control-label">Articles<br/><small class="text-navy">List</small></label>
                                <select class="select2_demo_2 col-sm-9" name="related_id[]" multiple="multiple">
                                    @foreach($articles as $key => $article)
                                        <option value="{{$key}}">{{$article}}</option>
                                    @endforeach
                                </select>
                                @component('components.error', ['errorName'=>'related_id[]'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="col-sm-12 row">
                                    <label for="document">Images</label>
                                    <div class="needsclick dropzone" id="document-dropzone"></div>
                                </div>
                                @component('components.error', ['errorName'=>'images'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="col-sm-12 row">
                                    <label for="document">Files</label>
                                    <div class="needsclick dropzone" id="document-dropzone2"></div>
                                </div>
                                @component('components.error', ['errorName'=>'files '])@endcomponent
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <label class="col-sm-2 control-label">Content</label>
                            <div class="form-group col-sm-10">
                            <textarea id="editor" name="content"></textarea>
                                @component('components.error', ['errorName'=>'content'])@endcomponent
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
    {{-- ...Some more scripts... --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>

<script>
    let uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{ route('upload.image') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles: ".png, .jpg, .jpeg",
        paramName: "image",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="images[]" value="' + response.path + '">')
            uploadedDocumentMap[file.name] = response.path
        },
        removedfile: function (file) {
            file.previewElement.remove()
            let name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        }
    }

    let uploadedDocumentMap2 = {}
    Dropzone.options.documentDropzone2 = {
        url: '{{ route('upload.file') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles: ".pdf, .xls",
        paramName: "file",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="files[]" value="' + response.path + '">')
            uploadedDocumentMap2[file.name] = response.path
        },
        removedfile: function (file) {
            file.previewElement.remove()
            let name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap2[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        }
    }
</script>
    <!-- Select2 -->
    <script src={{asset("js/plugins/select2/select2.full.min.js")}}></script>
    <script>
        $(".select2_demo_2").select2({
            placeholder: "Select Related Articles",
            allowClear: true,
            maximumSelectionLength: 10
        });

        $(document).ready(function () {
            $('#articleType').change(function () {
                let element = $(this);
                $.ajax({
                    type:'get',
                    url: "{{url("staff/index/ajax")}}/" + element.val(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(users){
                        console.log(users)
                        $('#userType').empty()
                        if(Object.keys(users).length != 0)
                        {
                            $('#userType').append("<option value=''>Select User</option>")
                            $.each(users, function(id, name){
                                $('#userType').append("<option value=" + id + ">" + name +"</option>")
                            });
                        }
                        else
                        {
                            $('#userType').append("<option value=''>No User</option>")
                        }
                    },
                    error:function () {
                        alert("Server Error");
                    }
                })
            });
        });
    </script>
@endsection
