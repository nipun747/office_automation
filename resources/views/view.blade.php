<html>


 <style>
table, th, td {
  border: 2px solid black;
   border-collapse:collapse;
   font-size: 12px;
   text-align: center;
}
h3{
  text-align: center;
}
</style> 

<body>
  <h3>Leave Application Form</h3>

<table style="width:100%">
  <tr>
    <th>Employee Name</th>
    <td colspan="4" width="25%">{{$leave_details->employee_name}}</td>
      <th>Application Date</th>
       <td colspan="4" width="25%">{{date('Y-m-d',strtotime($leave_details->created))}}</td>
  </tr>
  <tr>
    <th>Employee Id</th>
    <td colspan="4">{{$leave_details->employee_code}}</td>
    <th>Designation</th>
    <td colspan="4">{{$leave_details->designation}}</td>
    
  </tr>
  <tr>
    <th>Department</th>
    <td colspan="4">{{$leave_details->department}}</td>
    <th>Line Manager</th>
    <td colspan="4">{{$leave_details->line_manager}}</td>
  </tr>
  
</table>
<div style="margin:15px 0px"><h4 style="display: inline;">Remarks : </h4>{{$leave_details->remarks}}</div>



<table style="width:100%;border:0px !important">
  <tr>
  <td style="border:0px;font-size: 14px"><h4><b>Leave Category : </b>{{$leave_details->leave_category}}</h4></td>
  <td style="border:0px;font-size: 14px"><h4><b>Leave Type : </b>{{$leave_details->leave_type}}</h4></td>
</tr>
</table>


<h3 >Leave Application details</h3>
<table style="width:100%">
  <tr>
    <th>Leave Applied</th>
    <td colspan="4" width="25%">{{$leave_details->leave_applied}} day(s)</td>
      <th>Start Date</th>
       <td colspan="2" width="25%">{{$leave_details->start_date}}</td>
       <th>End Date</th>
       <td colspan="2" width="25%">{{$leave_details->end_date}}</td>
  </tr>  
  
</table>
<div style="margin:15px 0px"><h4 style="display: inline;">Reason : </h4>{{$leave_details->reason}}</div>

 <h3>Approval Section</h3>
 <table style="width:100%">
  <tr>
    <th width="20%">Duty Assign To</th>
    <td width="20%">{{$leave_details->duty_assign_name}}</td>
    <th width="20%" >Signature & Date</th>
    <td width="40%" >
@if($leave_details->status>1 && $leave_details->status<5)
      <img style="height:50px;width:300px" src= "{{url('/images')}}/{{$leave_details->duty_signature}}"> {{date('Y-m-d',strtotime($leave_details->created))}}
      @endif

    </td>
  </tr>
<tr>
    <th width="20%">Line Manager (LM)</th>
    <td width="20%">{{$leave_details->line_manager}}</td>
    <th width="20%" >Signature & Date</th>
    <td width="40%">
@if($leave_details->status==3 || $leave_details->status==4)
      <img style="height:50px;width:300px" src= "{{url('/images')}}/{{$leave_details->line_manager_signature}}"> {{date('Y-m-d',strtotime($leave_details->created))}}
@endif
    </td>
  </tr>
  <tr>
    <th width="20%">Final Clearance <br> (if other dept.involved)</th>
    <td colspan=3></td>
  </tr>
   
</table><br><br>
<div class="form-group">
   <b>Declaration</b>:I acknowledge that I have followed Leave Management process and during my absesce,my assigned task is taken care off by mentioned assigned person (Duty Assigned to)
</div><br><br>



<div>
        <label><b>Applicant Signature :</b> <img style="height:40px;width:300px" src= "{{url('/images')}}/{{$leave_details->applicant_signature}}"> </label>
        
  </div>
 <h3 >HRD Section</h3>
<table style="width:100%">
  <tr>
    <th>Leave Type</th>
     <th>Opening Balance</th>
       <th>Applied Leave</th>
       <th>Remaining Days</th>
       <th>Remarks</th>
  </tr>  
   <tr>
    <th>Sick Leave</th>
     <td></td>
       <td></td>
       <td></td>
       <td></td>
  </tr>  
  <tr>
    <th>Earned Leave</th>
     <td></td>
       <td></td>
       <td></td>
       <td></td>
  </tr>  
  
  <tr>
    <th  >Verified By</th>
     <td  colspan="1"></td>
       
       <th  >Sign & Date</td>
       <td  colspan="3"></td>
  </tr>  
</table>
</body>
</html>
