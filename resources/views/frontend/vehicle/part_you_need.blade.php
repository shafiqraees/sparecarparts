@extends('frontend.layout.layout')
@section('content')
    <!-- ======= Hero Section ======= -->
    <!-- ======= End Hero 03095783400

     ======= -->
    @if (session()->has('success'))
        <div class="alert alert-success">
            @if(is_array(session('success')))
                <ul>
                    @foreach (session('success') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @else
                {{ session('success') }}
            @endif
        </div>
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
    <main class="choose-part-container" id="part_type">
        <form class="container select-product">
            <div class="search-parts">
                <h1>Select the part you need</h1>
                <input type="text" name="search-part" id="keyword">
            </div>
            <div class="input-group">
                @isset($data->spareParts)
                    @foreach($data->spareParts as $part)
                        <span class="button-checkbox input-group-btn">
                        <button type="button" data-id="{{route('parttypes.youneed',$part->id)}}"  class="btn parts-select  filter-search" data-color="primary">{{$part->title}}</button>
                        <input type="checkbox" class="hidden" checked />
                        </span>
                    @endforeach
                @endisset

            </div>
            <div class="container sub-products" style="display: none">
                <label class="checkbox-part">

        <span class="checkbox-part-input">
          <input type="checkbox" name="checkbox">
          <span class="checkbox-part-control">
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' aria-hidden="true" focusable="false">
              <path fill='none' stroke='currentColor' stroke-width='3' d='M1.73 12.91l6.37 6.37L22.79 4.59' /></svg>
          </span>
        </span>
                    <span class="part-lable">Side Door</span>
                </label>
                <label class="checkbox-part">

        <span class="checkbox-part-input">
          <input type="checkbox" name="checkbox">
          <span class="checkbox-part-control">
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' aria-hidden="true" focusable="false">
              <path fill='none' stroke='currentColor' stroke-width='3' d='M1.73 12.91l6.37 6.37L22.79 4.59' /></svg>
          </span>
        </span>
                    <span class="part-lable">Side Door</span>
                </label>
                <label class="checkbox-part">

        <span class="checkbox-part-input">
          <input type="checkbox" name="checkbox">
          <span class="checkbox-part-control">
            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' aria-hidden="true" focusable="false">
              <path fill='none' stroke='currentColor' stroke-width='3' d='M1.73 12.91l6.37 6.37L22.79 4.59' /></svg>
          </span>
        </span>
                    <span class="part-lable">Side Door</span>
                </label>
            </div>
            <div class="parts-button-container">
                <input type="submit" name="parts-button">
            </div>
        </form>
    </main>
    <!-- Modal HTML -->
    <!-- Modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Spare Car Parts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary nextbutton" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

    $(document).ready(function() {
        $(document).on('click','.filter-search',function(e){
            e.preventDefault();

            $('#edit_modal').find('.modal-content').load($(this).attr("data-id"));
            $('#edit_modal').modal('show');
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

    });



</script>

