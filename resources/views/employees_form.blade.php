@extends('layouts.app')
@section('content')

  
  
 
<form enctype="multipart/form-data" action="{{url('/employee_form_submit')}}" method="post">
  @csrf
    <div class="col-lg-6 offset-lg-3">
  <h4 class="text-center">Add Employee</h4>
</div>
<div class="col-lg-12 row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="employee_code">Employee Code:</label>
          <input type="text" name="employee_code" class="form-control">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="designation">Designation:</label>    
           <select name="designation" class="form-control">
            @foreach($designations as $designation)
            <option value = "{{$designation->designation_id}}">{{$designation->designation}}</option>
            @endforeach
          </select>   
        </div>
      </div>
  </div>
  <div class="col-lg-12 row">
      <div class="col-lg-6">
        <div class="form-group">
        <label for="employee_name">Employee Name:</label>
        <input type="text" name="employee_name" class="form-control">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
        <label for="employee_name">Employee Email:</label>
        <input type="text" name="employee_email" class="form-control">
      </div>
      </div>
  </div>
  
  
<div class="col-lg-12 row">
  <div class="col-lg-6">
   <div class="form-group">
    <label for="department">Department:</label>
    <select name="department" class="form-control">
    @foreach($departments as $department)
    <option value="{{$department->department_id}}">{{$department->department}}</option>
    @endforeach
    </select>
    </div>
  </div>
  <div class="col-lg-6">
  <div class="form-group">
    <label for="line_manager">Line Manager:</label>   
     <select name="line_manager_id" class="form-control">
      @foreach($line_manager as $line_managers)
      <option value="{{$line_managers->employee_id}}">{{$line_managers->employee_name}}</option>
      @endforeach  
    </select>
  </div>
  </div>
  </div>
   <div class="form-group">
  <div class="col-lg-12 row">
 

  <div class="form-group ">
   <input type="checkbox" name="is_line_manager" value="1">Is Line Manager<br>
  </div>
  
   <div class="col-lg-12 row">
      <div class="form-group col-lg-6">
         <label>Profile Image</label>
        <div class="custom-file">
            <input id="logo" name="input_img" type="file" class="custom-file-input" onchange="set_image(this);">
            <label for="logo" class="custom-file-label">Choose file...</label>
        </div>
      <!-- </div>
     <div class="col-lg-6" style="background-color: white;text-align: center;vertical-align: middle"> -->
          <img class="change_img" id="image_preview" style="display: block; height: 300px;width: 350px"  src="{{url('/')}}/images/pp_images/img_avatar.png"  alt="Memo Image" />
      </div>

     <div class="form-group ">
          <label>Signature</label>
        <div class="custom-file">
            <input id="logo" name="input_signature" type="file" class="custom-file-input" onchange="set_signature(this);">
            <label for="logo" class="custom-file-label">Choose file...</label>
        </div>
           <img class="change_img" id="sig_preview" style="display: block; height: 50px;width: 350px"  src="{{url('/')}}/images/pp_images/Signature.png"  alt="Memo Image" />
      </div>
    </div>
    <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>

</div>
<script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        //alert("Settings page was loaded");
        //console.log("hii");
         
         $("p").click(function(){
    $(this).toggleClass("red");
        });
    });
</script>
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
        function set_signature(input){          
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#sig_preview')
                        .attr('src', e.target.result)
                        .width(350)
                        .height(50);
                }

                reader.readAsDataURL(input.files[0]);
                $('#sig_preview').show();
            }
        }
    </script>
@endsection