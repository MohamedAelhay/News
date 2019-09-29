
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
        $('#index-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route("roles.index") }}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                // {data: 'updated_at', name: 'updated_at'},
                // {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ]
        });
    });
</script>
