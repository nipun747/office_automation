

@extends('layouts.app')
@section('content')

    <link href="{{asset('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">

<form action="{{url('/leave_form_submit')}}" method="post">

	@csrf
<h3>Leave form</h3>
<div class="row">
		<div class="col-2 form-group has-feedback">
			<label>Leave Type</label>
 <select name="catagory" class="form-control">
  @foreach($catagories as $catagory)
  <option value = "{{$catagory->leave_category_id}}">{{$catagory->leave_category}}</option>
  @endforeach
  </select><br>
</div>
		<div class="col-2 form-group has-feedback">
<label>Choose a value:</label>

<select name="leave_type" class="form-control">
  <option >Full Day Leave</option>
  <option >Half Day Leave</option>
 </select>
</div>
<div class="col-2 form-group has-feedback">
	<label>Duty Assign to</label>
<select name="employee_name" class="form-control">
  @foreach($employee_names as $employee_name)
  <option value = "{{$employee_name->employee_id}}">{{$employee_name->employee_name}}</option>
  @endforeach
  </select><br>
</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-2 form-group has-feedback">
			<label>Start Date <span class="text-danger">*</span></label>
			 <div class="input-group date">
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="fromdate" 
				   placeholder="YYYY-MM-DD" name="fromdate">
				</div>
		</div>
		<div class="col-2 form-group has-feedback">
			<label>End Date: <span class="text-danger">*</span></label>
			 <div class="input-group date">
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control has-feedback-left" id="todate" 
				   placeholder="YYYY-MM-DD" name="todate">
				</div>
		</div>
		<div class="col-2 form-group has-feedback">
			<label>Leave Applied(days): <span class="text-danger">*</span></label>
			<div class="input-group date">
			<input type="text" readonly class="form-control has-feedback-left" name="numberofdays" 
				   id="numberdays" >
				</div>
		</div>

		<div class="form-group" id="data_1">
            <label class="font-normal">Simple data input format</label>
            <div class="input-group date">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="03/04/2014">
            </div>
        </div>
	</div>  
</div>
<div>
<label>Reason:</label>
<input class="form-control" type="text" name="reason">
</div>
<div>
<label>Remarks:</label>
<input class="form-control" type="text" name="remarks">
</div>
  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>
    <!-- Mainly scripts -->
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
