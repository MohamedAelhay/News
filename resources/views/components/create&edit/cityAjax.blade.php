<!-- Custom and plugin javascript -->
<script src={{ asset("js/inspinia.js")}}></script>
<script src={{ asset("js/plugins/pace/pace.min.js")}}></script>

<script>
    $(document).ready(function () {
        $('#country').change(function () {
            let country_id = $(this).val();
            $.ajax({
                type:'GET',
                url: "{{url($url)}}/" + country_id,
                success:function(cities){
                    $('#city').empty()
                    if(Object.keys(cities).length != 0)
                    {
                        $('#city').append("<option value=''>Select City</option>")
                        $.each(cities, function(name, id){
                            $('#city').append("<option value=" + id + ">" + name +"</option>")
                        });
                    }
                    else
                    {
                        $('#city').append("<option value=''>No City</option>")
                    }
                },
                error:function () {
                    alert("You Should Select Country");
                }
            })
        });
    });
</script>
<!-- Jasny For File Upload-->
<script src={{asset("js/plugins/jasny/jasny-bootstrap.min.js")}}></script>
