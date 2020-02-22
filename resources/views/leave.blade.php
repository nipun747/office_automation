@extends('layouts.app')
@section('content')

  
   <link href="{{asset('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
 
<form action="{{url('/leave_submit')}}" method="post">
  
 @csrf
    <div class="col-lg-6 offset-lg-3">
  <h4 class="text-center">Leave Form</h4>
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
    
      <label>Application Date <span class="text-danger">*</span></label>
       <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="fromdate" 
           placeholder="YYYY-MM-DD" name="fromdate">
        </div>
    </div>
   
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
          <label for="designation">Designation:</label>    
           <select name="designation" class="form-control">
            @foreach($designations as $designation)
            <option value = "{{$designation->designation_id}}">{{$designation->designation}}</option>
            @endforeach
          </select>   
        </div>
      </div>
       <div class="col-lg-12 row">
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
  <!--  <div class="col-lg-12 row">
     <div class="form-group">
    
      <label>Application Date <span class="text-danger">*</span></label>
       <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="fromdate" 
           placeholder="YYYY-MM-DD" name="fromdate">
        </div>
    </div> -->
   
 

    
  
  

  <div class="col-lg-12 row">
    <div class="text-center col-lg-12"><h3>Leave Category</h3></div>
  <div class="col-lg-6">
  <div class="form-group"> 
      <label>Leave Type</label>
 <select name="leave_category" class="form-control">
  @foreach($catagories as $catagory)
  <option value = "{{$catagory->leave_category_id}}">{{$catagory->leave_category}}</option>
  @endforeach
  </select><br>
</div>
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
</div>
 <div class="col-lg-12">
<label>Remarks:</label>
<input class="form-control" type="text" name="remarks">
</div>
<div>

   </div>
    <div class="container">
  <div class="row">
    <div class="text-center col-lg-12"><h3>Leave Application Details</h3></div>
 
    <div class="col-4 form-group has-feedback">
   
      <label>Start Date <span class="text-danger">*</span></label>
       <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="fromdate" 
           placeholder="YYYY-MM-DD" name="fromdate">
        </div>
    </div>
  

   <div class="col-4 form-group has-feedback">
      <label>End Date: <span class="text-danger">*</span></label>
       <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="todate" 
           placeholder="YYYY-MM-DD" name="todate">
        </div>
  </div>
  
  <div class="col-4 form-group has-feedback">
      <label>Leave Applied(days): <span class="text-danger">*</span></label>
      <div class="input-group date">
      <input type="text" readonly class="form-control has-feedback-left" name="numberofdays" 
           id="numberdays" >
        </div>
    </div>
 </div>
</div>


<div class="col-lg-12 row">

<label>Reason:</label>
<input class="form-control" type="text" name="reason">
</div>
</div>

 <div class="col-lg-12 row">
  <div class="text-center col-lg-12"><h3>Approval Section</h3></div>
  <div class="col-lg-6">
  <div class="form-group">
  <label>Duty Assign to</label>
<select name="employee_name" class="form-control">
  @foreach($employee_names as $employee_name)
  <option value = "{{$employee_name->employee_id}}">{{$employee_name->employee_name}}</option>
  @endforeach
  </select><br>
</div>
</div>

<div class="col-lg-6">
  <div class="form-group">
<div class="form-group">
        <label for="imageInput">Signature</label>
        <input  name="input_img" type="file" id="imageInput">
        <img class="col-sm-6" id="preview"  src="">
    </div>
  </div>
</div>
<div class="col-lg-12 row">
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
  <div class="col-lg-6">

<div class="form-group">
        <label for="imageInput">Signature</label>
        <input  name="input_img" type="file" id="imageInput">
        <img class="col-sm-6" id="preview"  src="">
    </div>
  </div>
</div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
<label>Final Clearance:</label>
<input class="form-control" type="text" name="reason">
</div><br>
</div>
  <div class="col-lg-12">

    <div class="form-group">
   <input type="checkbox" name="declaration" value="1"><b>Declaration</b>:I acknowledge that I have followed Leave Management process and during my absesce,my assigned task is taken care off by mentioned assigned person (Duty Assigned to)
</div><br>

</div>
<div class="col-lg-12">
<div class="form-group">
        <label for="imageInput">Applicant Signature</label>
        <input  name="input_img" type="file" id="imageInput">
        <img class="col-sm-6" id="preview"  src="">
    </div>
  </div>


 <div class="col-lg-12 row">
   <div class="text-center col-lg-12"><h3>HRD Section</h3></div>
  <div class="col-lg-6">
  <div class="form-group"> 
      <label>Leave Type</label>
 <select name="catagory" class="form-control">
  @foreach($catagories as $catagory)
  <option value = "{{$catagory->leave_category_id}}">{{$catagory->leave_category}}</option>
  @endforeach
  </select><br>
</div>
</div>
<div class="col-lg-6">
  <div class="form-group"> 
<label>Opening Balance:</label>
<input class="form-control" type="text" name="opening_balance">
</div>
</div>
</div>

 <div class="col-lg-12 row">

  <div class="col-lg-6">
     <div class="form-group">
    
      <label>Applied Leaves: <span class="text-danger">*</span></label>
       <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="fromdate" 
           placeholder="YYYY-MM-DD" name="fromdate">
        </div>
    </div>
  </div>
  <div class="col-lg-6">
  <div class="form-group">
      <label>Remaining Days: <span class="text-danger">*</span></label>
      <div class="input-group date">
      <input type="text" readonly class="form-control has-feedback-left" name="numberofdays" 
           id="numberdays" >
        </div>
    </div>
 </div>
</div>

    <div class="col-lg-12">
  
<label>Remarks:</label>
<input class="form-control" type="text" name="remarks">
</div>

 <div class="col-lg-6">
  <div class="form-group">
<div class="form-group">
        <label for="imageInput">Signature</label>
        <input  name="input_img" type="file" id="imageInput">
        <img class="col-sm-6" id="preview"  src="">
    </div>
  </div>
</div>
  </div>
   <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
@section('js')  

   <!-- Data picker -->
   <script src="{{asset('assets/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

    <!-- Date range use moment.js')}} same as full calendar plugin -->
    <script src="{{asset('assets/js/plugins/fullcalendar/moment.min.js')}}"></script>
        <!-- Date range picker -->
    <script src="{{asset('assets/js/plugins/daterangepicker/daterangepicker.js')}}"></script>

    
      

    <script>
        $(document).ready(function(){    
                

            var mem = $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            var yearsAgo = new Date();
            yearsAgo.setFullYear(yearsAgo.getFullYear() - 20);
        });
</script>


<script type="text/javascript">
$(function() {
  
  let $fromDate = $('#fromdate'),
    $toDate = $('#todate'),
    $numberDays = $('#numberdays');

  $fromDate.datepicker().on('change', function(){
    $toDate.datepicker('option', 'minDate', $(this).val());
    
    $numberDays.val(calculateDateDiff($toDate.val(), $(this).val()));
  });
  
  $toDate.datepicker().on('change', function(){
    $fromDate.datepicker('option', 'maxDate', $(this).val());
    
    $numberDays.val(calculateDateDiff($(this).val(), $fromDate.val()));
  });;
  
  function calculateDateDiff(endDate, startDate) {
    if (endDate && startDate) {
      let e = moment(endDate),
        s = moment(startDate);
      
      return e.diff(s, "days")+1;
    }
    
    return null;
  }
});
</script>
           
@endsection
