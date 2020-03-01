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
  <th style="text-align:left;" width="100%">Employee Name:</th>
  <th colspan="14">@if(session()->has('employee_name')) 
                     {{ Session::get('employee_name') }}@endif</th>
 </tr>
 <tr>
  <th >Date</th>
  <th >From</th>
  <th >To</th>
  <th >By</th>
  <th >Purpose</th>
  <th >Taka</th>
 <th >Profile Image</th>
 </tr>
 
   @foreach($employee as $employees)
 
  <tr>
  
  <td >{{$employees->date}}</td>
  <td >{{$employees->from}}</td>
  <td >{{$employees->to}}</td>
  <td >{{$employees->by}}</td>
  <td >{{$employees->purpose}}</td>
   <td >{{$employees->taka}}</td>
   <td ><img style="height:50px;width:300px" src= "{{url('/images')}}/{{$employees->profile_image}}"> </td>
 </tr>
 
 
 
  @endforeach
 
</table><br><br><br><br>
<p><b><u>Received by</u></b></p><br><br>
  <p><b><u>Prepared by</u></b></p><br><br>
  <p><b><u>Checked by</u></b></p><br><br>
  <p><b><u>Approved by</u></b></p><br><br>

</body>
</html>