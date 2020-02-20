@extends('layouts.app')
@section('content')
<a href="{{url('leave_show/pdf')}}">Convert into PDF</a>
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

<h2>Leave Details</h2>

<table style="width:100%">
   <tr>
    <th>Employee Id</th>
    <th>Employee Name</th>
    <th>Designation</th>
    <th>Department</th>
    <th>Application Date</th>
    <th>Leave Category</th>
    <th>Line Manager</th>
    <th>Leave Applied</th>
      
  </tr>

  @foreach($leave as $leaves)
  <tr>
    <td>{{$leaves->employee_id}}</td>
  <td>{{$leaves->employee_name}}</td>
    <td>{{$leaves->designation}}</td>
    <td>{{$leaves->department}}</td>
    <td>{{$leaves->application_date}}</td>
    <td>{{$leaves->leave_category}}</td>
    <td>{{$leaves->line_manager}}</td>
    <td>{{$leaves->leave_applied}}</td>
  </tr>
  @endforeach
</table>
 
@endsection