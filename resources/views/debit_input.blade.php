@extends('layouts.app')
@section('content')
<form action="{{url('/debit_submit')}}" method="post">
 
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
          <label for="particular">Particulars:</label>
          <input type="text" name="employee_code" class="form-control">
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
      </div>
     
     <button type="submit" class="btn btn-primary">Submit</button>
</body>
</form>
@endsection