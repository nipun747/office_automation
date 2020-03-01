@extends('layouts.app')
@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
  
  
 
<form enctype="multipart/form-data" action="{{url('/update_employee')}}" method="post">
  @csrf
    <div class="col-lg-6 offset-lg-3">
  <h4 class="text-center">Add Employee</h4>
</div>
<div class="col-lg-12 row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="employee_code">Employee Code:</label>
          <input type="text" name="employee_code" value="{{ $employee->employee_code }}" class="form-control" readonly>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="designation">Designation:</label>    
           <select name="designation" value="{{$employee->designation}}" class="form-control">
            @foreach($designations as $designation)
            <option  <?php if($designation->designation_id == $employee->designation_id) echo "selected" ?> value = "{{$designation->designation_id}}">{{$designation->designation}}</option>
            @endforeach
          </select>   
        </div>
      </div>
  </div>
  <div class="col-lg-12 row">
      <div class="col-lg-6">
        <div class="form-group">
        <label for="employee_name">Employee Name:</label>
        <input type="text" name="employee_name" value="{{$employee->employee_name}}" class="form-control">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
        <label for="employee_email">Employee Email:</label>
        <input type="text" name="employee_email" value="{{$employee->employee_email}}" class="form-control">
      </div>
      </div>
  </div>
  
  
<div class="col-lg-12 row">
  <div class="col-lg-6">
   <div class="form-group">
    <label for="department">Department:</label>
    <select name="department" value="{{$employee->department}}"  class="form-control">
    @foreach($departments as $department)
    <option  <?php if($department->department_id == $employee->department_id) echo  "selected" ?> value="{{$department->department_id}}">{{$department->department}}</option>
    @endforeach
    </select>
    </div>
  </div>
  <div class="col-lg-6">
  <div class="form-group">
    <label for="line_manager">Line Manager:</label>   
     <select name="line_manager_id" value="{{$employee->line_manager_id}}"  class="form-control">
      @foreach($line_manager as $line_managers)
      <option  <?php if($line_managers->employee_id == $employee->line_manager_id) echo "selected" ?>  value="{{$line_managers->employee_id}}">{{$line_managers->employee_name}}</option>
       @endforeach  
    </select>

  </div>
  </div>
  </div>
 
  

   
    <div class="form-group">
        <label for="profile_image">Profile Image</label>
        <input  name="profile_image" type="file" value="" id="imageInput">
        <img class="col-sm-6" id="preview"  src="">
    </div>
   
   <div class="form-group ">
        <label for="signature">Signature</label>
        <input  name="signature" value="" type="file" >
        <img class="col-sm-6" id="preview"  src="">
    </div>
    <label class="switch">
  <input type="checkbox" name="status" value="1" checked>
  <span class="slider round"></span>
</label>
    <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  
</form>

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
@endsection