@extends('layouts.app')
@section('content')
<form action="{{url('/conveyance_submit')}}" method="post">
	@csrf
	<style>
table, th, td {
  border: 1px solid black;
   border-collapse:collapse;
}
</style> 

<body >
  <h3 style="text-align: center;">Conveyance Sheet</h3>
  <table style="width:100%"
 >
 <tr>
  <th style="text-align:left;" colspan="8" width="100%">Employee Name:</th>
  <th colspan="14">@if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif</th>
 </tr>
 <tr>
  <th colspan="4" width="20%">Date</th>
  <th colspan="4" width="20%">From</th>
  <th colspan="4" width="20%">To</th>
  <th colspan="4" width="20%">By</th>
  <th colspan="4" width="20%">Purpose</th>
  <th colspan="4" width="20%">Taka</th>
 
 </tr>
 <tr>
  <td colspan="4" width="20%"><input type="text" name="date"></td>
  <td colspan="4" width="20%"><input type="text" name="from"></td>
  <td colspan="4" width="20%"><input type="text" name="to"></td>
  <td colspan="4" width="20%"><input type="text" name="by"></td>
  <td colspan="4" width="20%"><input type="text" name="Purpose"></td>
   <td colspan="4" width="20%"><input type="text" name="taka"></td>
 </tr>
 
 <tr>
  <th style="text-align:right;" colspan="20" width="60%">Total taka=</th>
  <td colspan="12" width="20%"><input type="text" name="total"></td>
 </tr>
 <tr>
  <th style="text-align:left;" colspan="20" width="100%">Taka in Word:</th>
  <td colspan="16" width="40%"><input type="text" name="word"></td>
 </tr>
 
 
</table><br><br><br><br>
<p><b><u>Received by</u></b></p>
<input type="text" name="received_by"><br><br>
  <p><b><u>Prepared by</u></b></p>
  @if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif
  
  <p><b><u>Checked by</u></b></p>
  <input type="text" name="checked_by"><br><br>
  <p><b><u>Approved by
  </u></b></p>
  <input type="text" name="approved_by"><br><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</body>
</form>

@endsection