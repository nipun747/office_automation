@extends('layouts.app')
@section('content')

  
  
 
<form enctype="multipart/form-data" action="{{url('/update_image')}}" method="post">
  @csrf
 <div class="form-group">
        <label for="profile_image">Profile Image</label>
      
    <div class="custom-file">
            <input id="logo" name="profile_image" type="file" class="custom-file-input" onchange="set_image(this);">
            <label for="logo" class="custom-file-label">Choose file...</label>
        </div>
      <!-- </div>
     <div class="col-lg-6" style="background-color: white;text-align: center;vertical-align: middle"> -->
          <img class="change_img" id="image_preview" style="display: block; height: 300px;width: 350px"  src="{{url('/')}}/images/pp_images/img_avatar.png"  alt="Memo Image" />
      </div>
     <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  </form>
  @endsection
  @section('js')
  <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        function set_image(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image_preview')
                        .attr('src', e.target.result)
                        .width(350)
                        .height(300);
                }

                reader.readAsDataURL(input.files[0]);
                $('#image_preview').show();
            }
        }
         </script>
@endsection