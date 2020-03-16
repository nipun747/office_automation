@extends('layouts.app')
@section('content')

  
  
 
<form enctype="multipart/form-data" action="{{url('/employee_form_submit')}}" method="post">
  @csrf
    <label for="create">Create Project:</label>
          <input type="text" name="project_name" class="form-control">
        
      
  <label> Assign Duty to</label>
<select name="employee_name" class="form-control">
  @foreach($employee_names as $employee_name)
  <option value = "{{$employee_name->employee_id}}">{{$employee_name->employee_name}}</option>
  @endforeach
  </select><br>

<h5>Create Task</h5>

<div class="col-lg-12 row">
      <div class="col-lg-6">
        <div class="form-group">
        <label for="task_name">Task Name:</label>
        <input type="text" name="task_name" class="form-control">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
        <label for="task_type">Task Type:</label>
        <input type="text" name="task_type" class="form-control">
      </div>
      </div>
  </div>

  <div class="container">
  <div class="row">
    <div class="col-2 form-group has-feedback">
      <label>Deadline:<span class="text-danger">*</span></label>
       <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="fromdate" 
           placeholder="YYYY-MM-DD" name="date">
        </div>
    </div>
  </div>
    <div class="col-lg-12 row">
  <label for="comment">comment:</label>

<textarea name="comment" >

</textarea>
</div>

    <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>
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



@endsection
