
    <!-- ======= Hero Section ======= -->
    <form class="container select-product" method="post" action="{{route('store.request.order')}}" enctype="multipart/form-data">
        @csrf
        <div class="search-parts">
            <h1>Enter the part you need</h1>
            <input type="text" name="search-part-blue" placeholder="Type then select the part you need">
        </div>
        <div class="input-group">
            <div class="container sub-products">
                @isset($data)
                    @foreach($data as $part)
                <label class="checkbox-part">

                    <input type="hidden" name="spare_part_type_id[]" value="{{$part->id}}">
                    <span class="checkbox-part-input">
            <input type="checkbox" id="{{$part->id}}" name="spare_part_types[]" value="{{$part->title}}">
            <span class="checkbox-part-control">
              <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' aria-hidden="true" focusable="false">
                <path fill='none' stroke='currentColor' stroke-width='3' d='M1.73 12.91l6.37 6.37L22.79 4.59' /></svg>
            </span>
          </span>
                    <span class="part-lable">{{$part->title}}</span>
                </label>
                    @endforeach
                @endisset
            </div>
        </div>
        <div class="upload-image">
            <div class="frame">
                <div class="additional-info-input container">
                    <textarea id="text" name="additionalinfo" placeholder="Additional information"></textarea>
                </div>
                <div class="center container">
                    <div class="dropzone">
                        <img src="{{asset('public/frontend/assets/img/image.png')}}" class="upload-icon" />
                        <input type="file" id="img" name="image[]" accept="image/*" class="upload-input" multiple />
                        <button type="submit" class="upload-button" name="uploadbutton">Add an image(Optional)</button>
                    </div>
                </div>
            </div>
            <div class="add-parts-button-container container">
                {{--<input type="submit" name="add-another-part" value="Add another part">
                <h3>OR</h3>--}}
                <input type="submit" name="next-step" value="Submit">
            </div>
        </div>
    </form>





