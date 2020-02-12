@extends('layouts.app')
@section('content')
<style>
table, th, td {
  border: 1px solid black;
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

<h2>Employee Table</h2>

<table style="width:100%">
   <tr>
    <th>Employee Name</th>
    <th>Designation</th>
    <th>Department</th>
    <th>Line Manager</th>
      
  </tr>

  @foreach($employee as $employees)
  <tr>
  <td>{{$employees->employee_name}}</td>
    <td>{{$employees->designation}}</td>
    <td>{{$employees->department}}</td>
    <td>{{$employees->line_manager_id}}</td>
  </tr>
  @endforeach
</table>
  <h2>Designation Table</h2>

<table style="width:100%">
   <tr>
  
    <th>Designation</th>
    
      
  </tr>

  @foreach($designation as $designation)
  <tr>
    <td>{{$designation->designation}}</td>
    
  </tr>
  @endforeach
</table>
 <h2>Leave</h2>

<table style="width:100%">
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
   
    <td>{{$catagory->employee}}</td>
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