@extends('app')
@section('title', 'Articles & News')
@section('styles')
    <link rel="stylesheet" href={{asset("css/plugins/dataTables/datatables.min.css")}}>
@endsection
@section('content')
<div id="wrapper">
    @component('components/main')@endcomponent
    <div id="page-wrapper" class="gray-bg">
        @component('components/navbar')@endcomponent
        <div class="row wrapper border-bottom white-bg page-heading">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-lg-10">
                <h2>Visitors</h2>
                <ol class="breadcrumb">
                    <li>
                        <a href={{route('home')}}>Home</a>
                    </li>
                    <li class="active">
                        <strong>Topics</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Topics</h5>

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href={{route('articles.create')}}>Create New Topic</a></li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Main Title</th>
                                            <th>Second Title</th>
                                            <th>Publish</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    {{--<tbody>rendered by DataTable</tbody>--}}
                                </table>
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
{{--    @component('components.ajax.toggleStatus')@endcomponent--}}
<script src={{asset("js/plugins/dataTables/datatables.min.js")}}></script>
<!-- Custom and plugin javascript -->
<script src={{ asset("js/inspinia.js")}}></script>
<script src={{ asset("js/plugins/pace/pace.min.js")}}></script>

<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 5,
            lengthMenu: [[1, 5, 10, -1], [1, 5, 10, "All"]],
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ],
            processing: true,
            // serverSide: true,
            ajax: "{{ route("articles.index") }}",
            columns: [
                {data: 'main_title'},
                {data: 'second_title'},
                {data: 'is_publish'},
                {data: 'type'},
                {data: 'actions', orderable: false, searchable: false}
            ]
        });

    });
</script>
@endsection
