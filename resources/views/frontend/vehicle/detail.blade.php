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
                    <h3>Make: {{$data['make']}}</h3>
                    <h3>Reg Number:  {{$data['registrationNumber']}}</h3>
                    <h3>Year: {{$data['yearOfManufacture']}}</h3>
                    <h3>Wheel Plan: {{$data['wheelplan']}}</h3>
                    <h3>Engine: {{$data['engineCapacity']}}</h3>
                    <h3>Fuel: {{$data['fuelType']}}</h3>
                    <h3>Month Of First Registration: {{$data['monthOfFirstRegistration']}}</h3>
                    <h3>Is this the correct vehicle?</h3>
                    <div class="approve-buttons">
                        <a class="yes-button" href="{{ url('find/car/spareparts/?registration_number='. $data['registrationNumber']) }}" >Yes</a>
                        <a class="no-button" href="#">No</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= End Hero ======= -->
@endsection

