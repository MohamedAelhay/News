@extends('app')
@section('title', 'Edit Topic')
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
                    <h5>Edit Topic</h5>

                </div>
                <div class="ibox-content">

                    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action={{route("articles.update", $topic->id)}}>
                        @csrf
                        @method('PUT')
                        <div class="row" style="padding: 20px">
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Main Title</label>
                                <input type="text" name="main_title" class="col-sm-8" value="{{ $topic->main_title }}"placeholder="Main Title" required="">
                                @component('components.error', ['errorName'=>'main_title'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label">Second Title</label>
                                <input type="text" name="second_title" class="col-sm-8" value="{{ $topic->second_title }}"placeholder="Second Title" required="">
                                @component('components.error', ['errorName'=>'second_title'])@endcomponent
                            </div>

                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">Type<br/><small class="text-navy">List</small></label>
                                <select name="type" class="col-sm-8" id="articleType">
                                    <option value="{{ $topic->type }}">{{($topic->type == 1) ? "News" : "Article"}}</option>
                                    <option value=1>Article</option>
                                    <option value=2>News</option>
                                </select>
                                @component('components.error', ['errorName'=>'type'])@endcomponent
                            </div>
                            <div class="form-group col-sm-6 row"><label class="col-sm-4 control-label" style="margin-top:-12px">User<br/><small class="text-navy">List</small></label>
                                <select name="user_id" class="col-sm-8" id="userType">
                                    <option value="{{$topic->user_id}}">{{$topic->user->fname}}</option>
                                    {{-- Script --}}
                                </select>
                                @component('components.error', ['errorName'=>'user_id'])@endcomponent
                            </div>
                            <div class="form-group col-sm-12 row"><label class="col-sm-2 control-label">Articles<br/><small class="text-navy">List</small></label>
                                <select class="select2_demo_2 col-sm-9" name="related_id[]" multiple="multiple">
                                    @foreach($articles as $key => $article)
                                        @if(in_array($key, $related->toArray()))
                                            <option value="{{$key}}" selected>{{$article}}</option>
                                        @else
                                            <option value="{{$key}}">{{$article}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="col-sm-12 row">
                                    <label for="document">Images</label>
                                    <div class="needsclick dropzone" id="document-dropzone"></div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="col-sm-12 row">
                                    <label for="document">Files</label>
                                    <div class="needsclick dropzone" id="document-dropzone2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <label class="col-sm-2 control-label">Content</label>
                            <div class="form-group col-sm-10">
                            <textarea id="editor" name="content">{{$topic->content}}</textarea>
                                @component('components.error', ['errorName'=>'content'])@endcomponent
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a class="btn btn-white" href="{{ URL::previous() }}">Cancel</a>
                                <button class="btn btn-primary" type="submit">Edit</button>
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

            if(file.id){
                $('form').append('<input type="hidden" name="deleted_images[]" value="' + file.id + '">')
            } else {
                $('form').find('input[name="images[]"][value="' + uploadedDocumentMap[file.name] + '"]').remove()
            }

        },
        init: function () {
            @if(isset($topic) && $topic->images)
                let files =
                {!! json_encode($topic->images) !!}
                    for (let i in files) {
                    let file = {};
                    file.id = files[i].id;
                    file.name = "Image";
                    file.size = "2000000";
                    file.path = "{{env("APP_URL")}}/storage/" + files[i].image;
                    console.log(files[i].image)
                    this.emit('addedfile', file);
                    this.emit('thumbnail', file, file.path);
                    this.emit('completed', file);
                    file.previewElement.classList.add('dz-complete')
                }
            @endif
        }
    }

    let uploadedDocumentMap2 = {}
    Dropzone.options.documentDropzone2 = {
        url: '{{ route('upload.file') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles: ".pdf, .xls",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="files[]" value="' + response.path + '">')
            uploadedDocumentMap2[file.name] = response.path
        },
        removedfile: function (file) {
            file.previewElement.remove()

            if(file.id){
                $('form').append('<input type="hidden" name="deleted_files[]" value="' + file.id + '">')
            } else {
                $('form').find('input[name="files[]"][value="' + uploadedDocumentMap2[file.name] + '"]').remove()
            }
        },
        init: function () {
            @if(isset($topic) && $topic->documents)
                let files =
                {!! json_encode($topic->documents) !!}
                for (let i in files) {
                    let file = {};
                    file.id = files[i].id;
                    file.name = "Document";
                    file.size = "2000000";
                    file.path = "{{env("APP_URL")}}/storage/" + files[i].document;

                    this.emit('addedfile', file);
                    this.emit('thumbnail', file, file.path);
                    this.emit('completed', file);
                    file.previewElement.classList.add('dz-complete')
                }
            @endif
        }
    }
</script>
    <!-- Select2 -->
    <script src={{asset("js/plugins/select2/select2.full.min.js")}}></script>
    <script>
        $(".select2_demo_2").select2({
            placeholder: "Select Related Articles",
            allowClear: true,
            max_selected_options:10
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
