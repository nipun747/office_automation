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
  
@endsection