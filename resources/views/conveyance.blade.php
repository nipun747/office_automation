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
 <tr>
  <td colspan="4" width="20%">1</td>
  <td colspan="4" width="20%">2</td>
  <td colspan="4" width="20%">3</td>
  <td colspan="4" width="20%">4</td>
  <td colspan="4" width="20%">5</td>
   <td colspan="4" width="20%">6</td>
 </tr>
 
 <tr>
  <th style="text-align:right;" colspan="16" width="60%">Total taka=</th>
  <td colspan="8" width="20%"></td>
 </tr>
 <tr>
  <th style="text-align:left;" colspan="24" width="100%">Taka in Word:</th>
  
 </tr>
 
 
</table><br><br><br><br>
<p><b><u>Received by</u></b></p><br><br>
  <p><b><u>Prepared by</u></b></p><br><br>
  <p><b><u>Checked by</u></b></p><br><br>
  <p><b><u>Approved by</u></b></p><br><br>
</body>
</html>