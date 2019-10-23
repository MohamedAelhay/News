@extends('app')
@section('title', 'Create Event')
@section('styles')
    @component('components.create&edit.style')@endcomponent

    <link rel="stylesheet" href={{asset("css/plugins/dropzone/basic.css")}}>
    <link rel="stylesheet" href={{asset("css/plugins/dropzone/dropzone.css")}}>

    <link rel="stylesheet" href={{asset("css/plugins/jasny/jasny-bootstrap.min.css")}}>
    <link rel="stylesheet" href={{asset("css/plugins/codemirror/codemirror.css")}}>


    <link rel="stylesheet" href={{asset("css/plugins/summernote/summernote.css")}}>
    <link rel="stylesheet" href={{asset("css/plugins/summernote/summernote-bs3.css")}}>

    <link rel="stylesheet" href={{asset("css/plugins/datapicker/datepicker3.css")}}>

    <link rel="stylesheet" href={{asset("css/plugins/clockpicker/clockpicker.css")}}>

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
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Event Create</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href={{route('home')}}>Home</a>
                            </li>
                            <li>
                                <a href={{route('events.index')}}>Events</a>
                            </li>
                            <li class="active">
                                <strong>Event Create</strong>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action={{route("events.store")}}>
                                        @csrf

                                        <div class="form-group"><label class="col-sm-2 control-label">Main Title:</label><div class="col-sm-10">
                                                <input type="text" class="form-control" name="main_title" value="{{ old('main_title') }}" placeholder="Main Title"></div>
                                            @component('components.error', ['errorName'=>'first_title'])@endcomponent
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Second Title:</label><div class="col-sm-10">
                                                <input type="text" class="form-control" name="second_title" value="{{ old('second_title') }}" placeholder="Second Title"></div>
                                            @component('components.error', ['errorName'=>'second_title'])@endcomponent
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Visitors<br/><small class="text-navy">List</small></label>
                                            <div class="col-sm-10">
                                                <select class="select2_demo_2 col-sm-9" name="visitors[]" multiple="multiple">
                                                    @foreach($visitors as $visitor)
                                                        <option value="{{$visitor->id}}">{{$visitor->user->fname}}</option>
                                                    @endforeach
                                                </select>
                                                @component('components.error', ['errorName'=>'visitors[]'])@endcomponent
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label" for="date_added">Start Date:</label>
                                            <div class="col-sm-4 input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input name="start_date" type="text" class="form-control" value="{{date('Y-m-d')}}">
                                            </div>
                                            @component('components.error', ['errorName'=>'start_date'])@endcomponent
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label" for="date_added">Start Time:</label>
                                            <div class="col-sm-4 input-group clockpicker" data-autoclose="true">
                                                <input name="start_time" type="text" class="form-control" value="09:30" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label" for="date_modified">End Date:</label><div class="col-sm-4 input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input name="end_date" type="text" class="form-control date" value="{{date('Y-m-d')}}">
                                            </div>
                                            @component('components.error', ['errorName'=>'end_date'])@endcomponent
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label" for="date_added">End Time:</label>
                                            <div class="col-sm-4 input-group clockpicker" data-autoclose="true">
                                                <input name="end_time" type="text" class="form-control" value="09:30" >
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Content:</label>
                                            <div class="col-sm-10">
                                                <textarea class="summernote" name="content"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Images:</label>
                                                <div class="col-sm-10 needsclick dropzone" id="document-dropzone"></div>
                                            @component('components.error', ['errorName'=>'images'])@endcomponent
                                        </div>

                                        <div class="form-group">
                                            <label for="address_address">Address</label>
                                            <input type="text"   name="address"  id="address-input"class="form-control map-input">
                                            <input type="hidden" name="latitude" id="address-latitude" value="0" />
                                            <input type="hidden" name="longitude" id="address-longitude" value="0" />
                                        </div>
                                        <div id="address-map-container" style="width:100%;height:400px; ">
                                            <div style="width: 100%; height: 100%" id="address-map"></div>
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

    <!-- SUMMERNOTE -->
    <script src={{asset("js/plugins/summernote/summernote.min.js")}}></script>

    <!-- Data picker -->
    <script src={{asset("js/plugins/datapicker/bootstrap-datepicker.js")}}></script>

    <!-- Clock picker -->
    <script src={{asset("js/plugins/clockpicker/clockpicker.js")}}></script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

            $('.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true,
                format: 'yyyy-mm-dd',
                assumeNearbyYear: 20
            });
            $('.clockpicker').clockpicker();
        });

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
            $('form').find('input[name="images[]"][value="' + name + '"]').remove()
        }
    }
</script>
    <!-- Select2 -->
    <script src={{asset("js/plugins/select2/select2.full.min.js")}}></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>

    <script>
        $(".select2_demo_2").select2({
            placeholder: "Select Visitors",
            allowClear: true,
        });
    </script>


    <script>
        function initialize() {

            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            const locationInputs = document.getElementsByClassName("map-input");

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;
            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                });

                marker.setVisible(isEdit);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({'placeId': place.place_id}, function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                });
            }
        }

        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
        }

    </script>

@endsection
