@extends('layouts.app')
@section('content')
<form action="{{url('/conveyance_submit')}}" method="post">
	@csrf
	

<body >
  <h3 style="text-align: center;">Conveyance Sheet</h3>
  
<div class="col-lg-12 row">
      <div class="col-lg-6">
        <div class="form-group">
          <label for="employee_code">Employee Name:@if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif</label>
          
        </div>
      </div>
  <div class="col-lg-12 row">
<div class="col-lg-6">
        <div class="form-group">
          <label for="employee_code">Date:</label>
           <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="date" class="form-control has-feedback-left" id="date" 
           placeholder="YYYY-MM-DD" name="date">
        </div>
        </div>
      </div>
      
        <div class="col-lg-6">
        <div class="form-group">
           <label for="from">From:</label>
         <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="date" class="form-control has-feedback-left" id="from" 
           placeholder="YYYY-MM-DD" name="from">
        </div>
      </div>
    </div>
     
 
      <div class="col-lg-12 row">
        <div class="col-lg-6">
        <div class="form-group">
          <label for="to">To:</label>
          <div class="input-group date">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="date" class="form-control has-feedback-left" id="to" 
           placeholder="YYYY-MM-DD" name="to">
        </div>
      </div>
    </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="by">By:</label>
          <input type="text" name="from" class="form-control">
        </div>
      </div>
    </div>
      <div class="col-lg-12 row">
        <div class="col-lg-6">
        <div class="form-group">
          <label for="purpose">purpose:</label>
          <input type="purpose" name="purpose" class="form-control">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label for="taka">Taka:</label>
          <input type="text" name="taka" class="form-control">
        </div>
      </div>
    </div>
 
<!-- <div class="col-lg-6">
        <div class="form-group">

  <label>Total taka=</label>
  <input type="text" name="total">
 </div>
</div>
<div class="col-lg-6">
        <div class="form-group">
 <label>Taka in Word:</label>
  <input type="text" name="word">
</div>
</div>

 
<div class="col-lg-6">
        <div class="form-group">
<label>Received by</label>
<input type="text" name="received_by">
</div>
</div>
  <div class="col-lg-6">
        <div class="form-group">
         <label>Prepared by
  @if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif
  </label> 
</div>
</div>
  <div class="col-lg-6">
        <div class="form-group">
 <label>Checked by</label>
  <input type="text" name="checked_by">
</div>
</div>
<div class="col-lg-6">
        <div class="form-group">
  <label>Approved by
  </label>
  <input type="text" name="approved_by">
</div>
</div> -->
  <button type="submit" class="btn btn-primary">Submit</button>
</body>
</form>

@endsection