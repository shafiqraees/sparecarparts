@extends('frontend.layout.layout')
@section('content')
    <!-- ======= Hero Section ======= -->
    <div class="vehicle-step1">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="vehicle-step1-img">

                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="vehicle-contents">

                    <h1>Vehicle Details</h1>
                    @if(isset($cars->image))
                    <img src="{{Storage::disk('public')->exists('sm/'.$cars->image) ? Storage::disk('public')->url('sm/'.$cars->image) : Storage::disk('public')->url('default.png')}}" alt="">
                    @endif
                    <div class="vehicle-details"></div>
                    <h3>Make: {{isset($data['make']) ? $data['make'] : ""}}</h3>
                    <h3>Reg Number:  {{isset($data['registrationNumber']) ? $data['registrationNumber'] : $data['registration']}}</h3>
                    <h3>Year:  {{isset($data['yearOfManufacture']) ? $data['yearOfManufacture'] : $data['year']}}</h3>
                    <h3>Wheel Plan:  {{isset($data['wheelplan']) ? $data['wheelplan'] : ""}}</h3>
                    <h3>Engine:  {{isset($data['engineCapacity']) ? $data['engineCapacity'] : $data['engine']}}</h3>
                    <h3>Fuel:  {{isset($data['fuelType']) ? $data['fuelType'] : $data['fuel']}}</h3>
                    <h3>Month Of First Registration:  {{isset($data['monthOfFirstRegistration']) ? $data['monthOfFirstRegistration'] : ""}}</h3>
                    <h3>Is this the correct vehicle?</h3>
                    <div class="approve-buttons">
                        @if(isset($cars->id))
                        <a class="yes-button" id="yes-button" href="{{route('part.youneed',$cars->id)}}" >Yes</a>
                        @else
                            <a class="yes-button" id="yes-button" href="javascript:void(0)" >Yes</a>
                        @endif
                        <a class="no-button" href="#">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= End Hero ======= -->

    <!-- Modal HTML -->

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    $(document).ready(function() {
        $("#yes-button").click(function () {
            //toastr.success('Request successfully submitted');
            $("#part_type").show();
        });
        $("#keyword").keyup(function() {

            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(),
                count = 0;
            // Loop through the comment list
            $('.filter-search').each(function() {


                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).hide();

                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).show();
                    count++;
                }
            });
        });
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
        $(".filter-search").click(function(e){
            e.preventDefault();
            var id = $(this).attr("data-id");


            $.ajax({

                type:'get',

                url:"{{ route('parts.type') }}",

                data:{id:id},

                success:function(response){
                    $("#part_type").hide();
                    //var my_orders = $("#success_product");
                    $.each(response.data, function(i, value){
                        console.log(value.title);
                        $('#success_product').append('<span class="button-checkbox input-group-btn"><button type="button" data-id="'+value.id+'" class="btn parts-select request_order" data-color="primary">'+value.title+'</button></span>');
                    });

                }

            });
        });
        $(document).on('click', '.request_order', function(e) {
       // $(".request_order").click(function(e){

            e.preventDefault();

            var id = $(this).attr("data-id");

            $.ajax({

                type:'post',

                url:"{{ route('store.request.order') }}",

                data:{id:id},

                success:function(response){
                    toastr.success('Request successfully submitted');
                    console.log(response);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    toastr.error('Please first Login');
                }

            });
        });
    });



</script>

