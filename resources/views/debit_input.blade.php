@extends('layouts.app')
@section('content')
<form action="{{url('/debit_submit')}}" method="post">
 
@csrf
<body>
  <div class="col-lg-12">
         <div class="form-group">
          <label for="account_name">Account Name:</label>
          @if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif
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
      <div class="container">
  <div class="row">
    <div class="col-2 form-group has-feedback">
          <label for="received_by">Received By:</label>
          <input type="text" name="received_by" class="form-control">
        </div>
     
    <div class="col-2 form-group has-feedback">
          <label for="prepared_by">Prepared By:</label>
          <input type="text" name="prepared_by" class="form-control">
        </div>
        <div class="col-2 form-group has-feedback">
          <label for="checked_by">Checked By:</label>
          <input type="text" name="checked_by" class="form-control">
        </div>
         <div class="col-2 form-group has-feedback">
          <label for="approved_by">Approved By:</label>
          <input type="text" name="approved_by" class="form-control">
        </div>
      </div>
    </div>
     <button type="submit" class="btn btn-primary">Submit</button>
</body>
</form>
@endsection