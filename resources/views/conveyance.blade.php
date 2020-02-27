<html>
<a href="{{url('index')}}">Convert into PDF</a>
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
 
   @foreach($employee as $employees)
 
  <tr>
  
  <td colspan="4" width="20%">{{$employees->date}}</td>
  <td colspan="4" width="20%">{{$employees->from}}</td>
  <td colspan="4" width="20%">{{$employees->to}}</td>
  <td colspan="4" width="20%">{{$employees->by}}</td>
  <td colspan="4" width="20%">{{$employees->purpose}}</td>
   <td colspan="4" width="20%">{{$employees->taka}}</td>
 </tr>
 
 <tr>
  <th style="text-align:right;" colspan="16" width="60%">Total taka=</th>
  <td colspan="8" width="20%">{{$employees->total}}</td>
 </tr>
 
  @endforeach
 
</table><br><br><br><br>
<p><b><u>Received by</u></b></p><br><br>
  <p><b><u>Prepared by</u></b></p><br><br>
  <p><b><u>Checked by</u></b></p><br><br>
  <p><b><u>Approved by</u></b></p><br><br>

</body>
</html>