@extends('layouts.app')
@section('content')
<form enctype="multipart/form-data" action="{{url('/debit_submit')}}" method="post">
 
@csrf
<body>
  <div class="col-lg-12 row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="employee_name">Employee Name:@if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif</label>
          
        </div>
      </div>
  <div class="col-lg-12 row">
<div class="col-lg-6">
        <div class="form-group">
          <label for="date">Date:</label>
           <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="date" class="form-control has-feedback-left" id="date" 
           placeholder="YYYY-MM-DD" name="date">
        </div>
        </div>
      </div>
 <div class="col-lg-12 row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="particulars">Particulars:</label>
          <input type="text" name="particular" class="form-control">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="taka">Taka:</label>
          <input type="text" name="taka" class="form-control">
        </div>
      </div>
       <div class="col-lg-12">
       <div class="form-group">
          <label for="total_taka">Total Taka:</label>
          <input type="text" name="total_taka" class="form-control">
        </div>
      </div>
      <div class="col-lg-12">
         <div class="form-group">
          <label for="taka_in_word">Taka in Word:</label>
          <input type="text" name="taka_in_word" class="form-control">
        </div>
      </div><div class="col-lg-12 row">
      <div class="form-group col-lg-6">
         <label>Attachment</label>
        <div class="custom-file">
            <input id="logo" name="profile_image" type="file" class="custom-file-input" onchange="set_image(this);">
            <label for="logo" class="custom-file-label">Choose file...</label>
        </div>
      <!-- </div>
     <div class="col-lg-6" style="background-color: white;text-align: center;vertical-align: middle"> -->
          <img class="change_img" id="image_preview" style="display: block; height: 300px;width: 350px"  src="{{url('/')}}/images/pp_images/img_avatar.png"  alt="Memo Image" />
      </div>


</div>
    <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</body>
</form>
<script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
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
    