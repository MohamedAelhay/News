<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href={{asset("css/bootstrap.min.css")}}>
    <link rel="stylesheet" href={{asset("font-awesome/css/font-awesome.css")}}>

    @yield('styles')

    <link rel="stylesheet" href={{asset("css/animate.css")}}>
    <link rel="stylesheet" href={{asset("css/style.css")}}>


{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}

    @yield('reCaptcha')
</head>
<body @yield('body', '')>
    @yield('content')

    <!-- Mainly scripts -->
    <script src={{ asset("js/jquery-3.1.1.min.js") }} ></script>
    <script src={{ asset("js/bootstrap.min.js") }}></script>
    <script src={{ asset("js/plugins/metisMenu/jquery.metisMenu.js") }}></script>
    <script src={{ asset("js/plugins/slimscroll/jquery.slimscroll.min.js") }}></script>

    @yield('scripts')
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
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
                ]

            });

        });

    </script>
</body>
</html>
