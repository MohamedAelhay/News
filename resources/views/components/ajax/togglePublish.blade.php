<script>
    $(document).ready(function () {
        $('.status').click(function () {
            let id = $(this).attr("id");
            let element = $(this);
            $.ajax({
                type:'PUT',
                url: "{{url("toggle/publish")}}/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(){
                    element.toggleClass('label-primary label-default');
                    (element.hasClass("label-primary")) ? element.text("Publish") : element.text("Un-publish");
                },
                error:function () {
                    alert("Server Error");
                }
            })
        });
    });
</script>
