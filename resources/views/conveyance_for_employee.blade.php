<html>
  <style>
table, th, td {
  border: 1px solid black;
   border-collapse:collapse;
   text-align: center;
}
.signTable th,.signTable td{
  border: 0px !important;
}
</style> 
<body>
<h2>Conveyance Sheet</h2>
        
<h4>Employee Name : {{$leave_details->name}}</h4>

<table width="100%" > 
  <tr>
  <th colspan="1">Date</th>
  <th colspan="1" >From</th>
  <th colspan="1" >To</th>
  <th colspan="1">By</th>
  <th colspan="1">Purpose</th>
  <th colspan="1">Taka</th>
 
 </tr>
  <tr>
  
  <td >{{date('d M Y',strtotime($leave_details->date))}}</td>
  <td >{{$leave_details->from}}</td>
  <td >{{$leave_details->to}}</td>
  <td >{{$leave_details->by}}</td>
  <td >{{$leave_details->purpose}}</td>
  <td >{{$leave_details->taka}}</td>
   
 </tr>
 
 
 
 
 
</table><br><br><br><br>
<table class="signTable" style="width: 100%;border:0px !important;">
  <tr>
    <td>
      <img style="height:20px;width:50px" src="{{url('/images')}}/{{$leave_details->applicant_signature}}">
    </td>
    <td>
      <img style="height:20px;width:50px" src="{{url('/images')}}/{{$leave_details->applicant_signature}}"></td>
      <td>
     @if($leave_details->status>1 && $leave_details->status<5)
      <img style="height:20px;width:50px" src="{{url('/images')}}/{{$leave_details->line_manager_signature}}">@endif
    </td>
    <td>
      @if($leave_details->status==3 || $leave_details->status==4)
      <img style="height:20px;width:50px" src="{{url('/images')}}/{{$leave_details->hr_signature}}">
      @endif
    </td>
  </tr>
  <tr>
    <td>---------------------------</td>
    <td>---------------------------</td>
    <td>---------------------------</td>
    <td>---------------------------</td>
  </tr>

  <tr>
    <th>Received by : </th>
    <th>Prepared By :</th>
    <th>Checked by : </th>
    <th>Approved by : </th>
  </tr>
</table>
<br>
<h4><u>Attachment</u></h4>
<img style="height:200px;width:150px" src="{{url('/images')}}/{{$leave_details->profile_image}}">
</body>
</html>