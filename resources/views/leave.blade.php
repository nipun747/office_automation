@extends('layouts.app')
@section('content')

  
  
 
<form  method="post">
  
    <div class="col-lg-6 offset-lg-3">
  <h4 class="text-center">Leave Form</h4>
</div>
<div class="col-lg-12 row">
      
      <div class="col-lg-6">
        <div class="form-group">
        <label for="employee_id">Employee Id:</label>
        <input type="text" name="employee_id" class="form-control">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
        <label for="employee_name">Employee Name:</label>
        <input type="text" name="employee_name" class="form-control">
        </div>
      </div>
      <div class="col-lg-12 row">
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
      <div class="col-lg-6">
        <div class="form-group">
          <label for="department">Department:</label>    
           <select name="designation" class="form-control">
            @foreach($departments as $department)
            <option value = "{{$department->department_id}}">{{$department->department}}</option>
            @endforeach
          </select>   
        </div>
      </div>
  </div>
   <div class="col-lg-12 row">
     <div class="form-group">
    
      <label>Application Date <span class="text-danger">*</span></label>
       <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="fromdate" 
           placeholder="YYYY-MM-DD" name="fromdate">
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
  <div class="col-lg-12 row">
  <div class="col-lg-6">
  <div class="form-group">
    
      <label>Leave Type</label>
 <select name="catagory" class="form-control">
  @foreach($catagories as $catagory)
  <option value = "{{$catagory->leave_category_id}}">{{$catagory->leave_category}}</option>
  @endforeach
  </select><br>
</div>
     <div class="col-lg-6">
  <div class="form-group">
<label>Choose a value:</label>

<select name="leave_type" class="form-control">
  <option >Full Day Leave</option>
  <option >Half Day Leave</option>
 </select>
</div>
</div>
<div class="col-lg-12 row">
  <div class="col-lg-6">
  <div class="form-group">
      <label>Start Date <span class="text-danger">*</span></label>
       <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="fromdate" 
           placeholder="YYYY-MM-DD" name="fromdate">
        </div>
    </div>
     <div class="col-lg-6">
  <div class="form-group">
      <label>End Date: <span class="text-danger">*</span></label>
       <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="todate" 
           placeholder="YYYY-MM-DD" name="todate">
        </div>
    </div>
    </div>
 
@endsection