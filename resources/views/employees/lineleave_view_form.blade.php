@extends('layouts.app')
@section('content')
<style>
table, th, td {
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
table#t01 {
  width: 100%;    
  background-color: #f1f1c1;
}
i{
  cursor: pointer;
}
</style>
</head>
<body>
 <h2>Leave</h2>

<table class="table table-striped">
   <tr>
    <th>Applicant</th>    
    <th>Leave Type</th>    
     <th>Hour of leave</th>    
    <th>Start Date</th>
    <th>End Days</th>
    <th>Leave Applied</th>
    <th>Reason</th>
    <th>Remarks</th>
    <th>Leave Status</th>
    <th>Action</th>
     <th>Download</th>
     
  </tr>

  @foreach($lineDuty as $catagory)
  <tr>
    <td>{{$catagory->employee_name}}</td>
    <td>{{$catagory->leave_category}}</td> 
    
     <td>{{$catagory->leave_type}}</td>

    <td>{{$catagory->start_date}}</td>
    <td>{{$catagory->end_date}}</td>
    <td>{{$catagory->leave_applied}}</td>
    <td>{{$catagory->reason}}</td>
    <td>{{$catagory->remarks}}</td>
    <td>{{$catagory->leave_status}}</td>
    @if($catagory->status == 2)
    <td class="action_td{{$catagory->leave_id}}"><a onclick="lineacceptReject_duty({{$catagory->leave_id}},1)"><i  class="fa fa-check"></i></a><a onclick="lineacceptReject_duty({{$catagory->leave_id}},0)"> <i class="fa fa-times"></i></a>
    </td>
    @else
    <td>{{$catagory->next_status}}</td>
    @endif
     <td><a href="{{url('/view_pdf')}}/{{$catagory->leave_id}}"><i class = "fa fa-download"></i><a></td>
  </tr>
  @endforeach
</table>  
@endsection
@section('js')
<script type="text/javascript">
  function lineacceptReject_duty(leave_id,status){    
  
    $.ajax({
      url: "{{url('/lineacceptReject_Duty')}}",
      type: 'GET',
      data: {leave_id:leave_id,status:status},
      success: function(response) {
            if(response == 3){
              $('.action_td'+leave_id).html('');
              $('.action_td'+leave_id).html('<span class="label label-primary">Accepted</span>');
            }else if(response == 5){
              $('.action_td'+leave_id).html('');
              $('.action_td'+leave_id).html('<span class="label label-danger">Rejected</span>');
            }else{

            }
      }
    });
}
</script>
@endsection