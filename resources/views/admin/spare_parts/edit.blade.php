@extends('admin.layouts.main')
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Spare parts</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a> </li>
                                <li class="breadcrumb-item"><a href="{{route('sparepart.index')}}">Spare parts</a> </li>
                                <li class="breadcrumb-item active">edit </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success"> @if(is_array(session('success')))
                        <ul>
                            @foreach (session('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ session('success') }}
                    @endif </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="content-body">
                <form class="form-horizontal" id="formsss" method="post" action="{{route('sparepart.update',$data->id)}}" name="specifycontent" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <section id="card-bordered-options">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="card box-shadow-0 border-dark">
                                    <div class="card-header card-head-inverse bg-dark">
                                        <h4 class="card-title text-white">Update Spare part</h4>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <fieldset class="form-group row">
                                                <div class="col-md-6 mt-1">
                                                    <label class="inline-block" for="sel1">Title </label>
                                                    <input type="text" name="title" value="{{$data->title}}" class="form-control heightinputs" id="basicInput" required>
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <label class="inline-block" for="sel1">description </label>
                                                    <input type="text" name="description" value="{{$data->description}}" class="form-control heightinputs" id="basicInput" required>
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <label class="inline-block" for="sel1">Price </label>
                                                    <input type="text" name="price" value="{{$data->price}}" class="form-control heightinputs" id="basicInput" required>
                                                </div>
                                                <div class="col-md-6 mt-1">
                                                    <label class="inline-block" for="sel1">Status</label>
                                                    <select class="form-control" aria-invalid="false" name="status" required>
                                                        <option value="Publish" {{ ( $data->status == "Publish") ? 'selected' : '' }}>Publish</option>
                                                        <option value="Unpublish" {{ ( $data->status == "Unpublish") ? 'selected' : '' }}>Unpublish</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mt-1">

                                                    <div class="form-group ">
                                                        <label class="inline-block" for="sel1">Images</label>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-dark border-dark white" id="basic-addon7 fonticon-container">
                                                            <div class="fonticon-wrap">
                                                                <i class="ft-image"></i>
                                                            </div>
                                                                    </span>
                                                            </div>
                                                            <input type="file" name="profile_pic"  id="basicInputfiled" class="form-control  heightinputs errormessage " name="bannerupload" accept="image/*" required>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 mt-3">
{{--                                                    <input type="file" name="profile_pic" class="form-control">--}}
{{--                                                    <img src="{{Storage::disk('s3')->exists('xs/'.$data->image) ? Storage::disk('s3')->url('xs/'.$data->image) : Storage::disk('s3')->url('default.png')}}" />--}}
                                                </div>
                                            </fieldset>
                                            <div class="form-actions float-right mt-0 pt-0 buttonbordertop">
                                                <button type="submit" class="btn btn-social btn-dark btn-dark text-center  pr-1"> <span class="la la-check font-medium-3"></span> Update </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
@endsection
