@extends('app')
@section('title', 'Event Details')
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
                    <h2>Event Details</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href={{route('home')}}>Home</a>
                        </li>
                        <li class="active">
                            <a href={{route('events.index')}}>Events</a>
                        </li>
                        <li class="active">
                            <strong>{{$event->main_title}}</strong>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Event</h5>

                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href={{route('events.create')}}>Create New Event</a>
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
                                        <th data-toggle="true">Main Title</th>
                                        <th>Second Title</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                        <th data-hide="all">Visitors</th>
                                        <th data-hide="all">Image</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$event->main_title}}</td>
                                            <td>{{$event->second_title}}</td>
                                            <td>{{$event->start_date}}</td>
                                            <td>{{$event->end_date}}</td>
                                            <td class="text-left">
                                                <div class="btn-group">
                                                    <a class="btn-white btn btn-xs" href={{route('events.edit', $event->id)}}>Edit</a>
                                                    <form method="POST" role="form" class="form-horizontal" style="display: inline;" action={{route('events.destroy', $event->id)}}>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn-white btn btn-xs">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>
                                                @foreach($event->visitors as $visitor)
                                                    <ul>{{$visitor->user->fname}}</ul>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($event->images as $image)
                                                    <img src="{{ Storage::url($image->image)}}" alt="No Image" class="img-thumbnail" height="50px" width="100px">
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="ibox">

                                    <div class="ibox-title">
                                        <h5>Location: {{$event->locations->address}}</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="google-map" id="map1" style="height: 300px; width:100%"></div>
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
    @component('components.index.scripts')@endcomponent
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAilhmQ53WmMriu4R0VmosM2o3HBqo4pqo"></script>
    <script type="text/javascript">
        // When the window has finished loading google map
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Options for Google map
            // More info see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            let lat = "{{$event->locations->latitude}}";
            let long= "{{$event->locations->longitude}}";
            var mapOptions1 = {
                zoom: 11,
                center: new google.maps.LatLng(lat, long),
                // Style for Google Maps
                styles: [
                    {
                        "featureType":"water",
                        "stylers":[{"saturation":43}, {"lightness":-11}, {"hue":"#0088ff"}]
                    }, {
                        "featureType":"road",
                        "elementType":"geometry.fill",
                        "stylers":[{"hue":"#ff0000"}, {"saturation":-100}, {"lightness":99}]
                    }, {
                        "featureType":"road",
                        "elementType":"geometry.stroke",
                        "stylers":[{"color":"#808080"}, {"lightness":54}]
                    }, {
                        "featureType":"landscape.man_made",
                        "elementType":"geometry.fill",
                        "stylers":[{"color":"#ece2d9"}]
                    }, {
                        "featureType":"poi.park",
                        "elementType":"geometry.fill",
                        "stylers":[{"color":"#ccdca1"}]
                    }, {
                        "featureType":"road",
                        "elementType":"labels.text.fill",
                        "stylers":[{"color":"#767676"}]
                    }, {
                        "featureType":"road",
                        "elementType":"labels.text.stroke",
                        "stylers":[{"color":"#ffffff"}]
                    }, {
                        "featureType":"poi",
                        "stylers":[{"visibility":"off"}]
                    }, {
                        "featureType":"landscape.natural",
                        "elementType":"geometry.fill",
                        "stylers":[{"visibility":"on"},{"color":"#b8cb93"}]
                    }, {
                        "featureType":"poi.park",
                        "stylers":[{"visibility":"on"}]
                    }, {
                        "featureType":"poi.sports_complex",
                        "stylers":[{"visibility":"on"}]
                    }, {
                        "featureType":"poi.medical",
                        "stylers":[{"visibility":"on"}]
                    }, {
                        "featureType":"poi.business"
                        ,"stylers":[{"visibility":"simplified"}]
                    }]
            };

            // Get all html elements for map
            var mapElement1 = document.getElementById('map1');

            // Create the Google Map using elements
            var map1 = new google.maps.Map(mapElement1, mapOptions1);
        }
    </script>
@endsection
