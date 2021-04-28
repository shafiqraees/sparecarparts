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
                    <img src="{{asset('public/frontend/assets/img/brand1.png')}}" alt="">
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
                        <a class="yes-button" href="javascript:void(0)" >Yes</a>
                        <a class="no-button" href="#">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= End Hero ======= -->
    <main class="choose-part-container" style="display: none">
        <form class="container select-product" action="{{ url('find/car/spareparts/?registration_number=adasd') }}">
            <div class="search-parts">
                <h1>Select the part you need</h1>
                <input type="text" name="search-part">
            </div>
            <div class="input-group">
      <span class="button-checkbox input-group-btn">
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
        <input type="checkbox" class="hidden" checked />
      </span>
                <span class="button-checkbox input-group-btn">
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
        <input type="checkbox" class="hidden" checked />
      </span><span class="button-checkbox input-group-btn">
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
        <input type="checkbox" class="hidden" checked />
      </span>
                <span class="button-checkbox input-group-btn">
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
        <input type="checkbox" class="hidden" />
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
                <span class="button-checkbox input-group-btn">
        <input type="checkbox" class="hidden" checked />
        <button type="button" class="btn parts-select" data-color="primary">Title</button>
      </span>
            </div>
            <div class="parts-button-container">
                <input type="submit" name="parts-button">
            </div>
        </form>
    </main>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $('.yes-button').click(function(){
        alert();
    });
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $(".btn-submit").click(function(e){



        e.preventDefault();



        var name = $("input[name=name]").val();

        var password = $("input[name=password]").val();

        var email = $("input[name=email]").val();



        $.ajax({

            type:'POST',

            url:"{{ route('ajaxRequest.post') }}",

            data:{name:name, password:password, email:email},

            success:function(data){

                alert(data.success);

            }

        });
    });
</script>

