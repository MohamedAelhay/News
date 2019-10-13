<!-- FooTable -->
<script src={{ asset("js/plugins/footable/footable.all.min.js")}}></script>

<!-- Custom and plugin javascript -->
<script src={{ asset("js/inspinia.js")}}></script>
<script src={{ asset("js/plugins/pace/pace.min.js")}}></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
    });
</script>
