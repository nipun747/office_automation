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
</style>
</head>
<body>
 <h2>Leave</h2>

<table class="table table-striped">
   <tr>
  
    <th>Leave Type</th>
    <th>Duty Assign to</th>    
     <th>Hour of leave</th>    
    <th>Start Date</th>
    <th>End Days</th>
    <th>Leave Applied</th>
    <th>Reason</th>
    <th>Remarks</th>
     
  </tr>

  @foreach($catagory as $catagory)
  <tr>
    <td>{{$catagory->catagory}}</td>
   
    <td>{{$catagory->employee_name}}</td>
     <td>{{$catagory->leave_type}}</td>

    <td>{{$catagory->start_date}}</td>
    <td>{{$catagory->end_date}}</td>
    <td>{{$catagory->leave_applied}}</td>
    <td>{{$catagory->reason}}</td>
    <td>{{$catagory->remarks}}</td>
     
  </tr>
  @endforeach
</table>  
@endsection