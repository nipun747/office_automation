@extends('layouts.app')
@section('content')
<form action="{{url('/leave_form_submit')}}" method="post">
	@csrf
<h3>Leave Category</h3>
 <select name="leave" class="form-control">
  @foreach($catagories as $catagory)
  <option value = "{{$catagory->leave_id}}">{{$catagory->catagory}}</option>
  @endforeach
  </select><br>
 <input type="radio" name="leave_type">Full Day Leave<br>
<input type="radio" name="leave_type">Half Day Leave<br>
<div class="container">
	<div class="row">
		<div class="col-12 form-group has-feedback">
			<label>Start Date <span class="text-danger">*</span></label>
			<input type="text" class="form-control has-feedback-left" id="fromdate" 
				   placeholder="MM/DD/YYYY" name="fromdate">
		</div>
		<div class="col-12 form-group has-feedback">
			<label>End Date: <span class="text-danger">*</span></label>
			<input type="text" class="form-control has-feedback-left" id="todate" 
				   placeholder="MM/DD/YYYY" name="todate">
		</div>
		<div class="col-12 form-group has-feedback">
			<label>Leave Applied(days): <span class="text-danger">*</span></label>
			<input type="text" class="form-control has-feedback-left" name="numberdays" 
				   id="numberdays" disabled>
		</div>
	</div>  
</div>
<label>Duty Assign To</label>
  <input type="text" name="assign" class="form-control">

  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>
<script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('js')
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
			
			return e.diff(s, "days");
		}
		
		return null;
	}
});
</script>


@endsection