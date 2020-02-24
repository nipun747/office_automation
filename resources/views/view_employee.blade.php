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
    <th>Employee Code</th>    
    <th>Designation</th>    
    <th>Employee Name</th>    
    <th>Employee Email</th>
    <th>Department</th>
    <th>Line Manager</th>
    <th>Password</th>
    <th>Is Line Manager</th>
    <th>Profile Image</th>
    <th>Signature</th>
  </tr>

  @foreach($employee as $employee)
  <tr>
    <td>{{$employee->employee_code}}</td>
    <td>{{$employee->designation}}</td> 
    
     <td>{{$employee->employee_name}}</td>

    <td>{{$employee->employee_email}}</td>
    <td>{{$employee->department}}</td>
    <td></td>
    <td>{{$employee->password}}</td>
    <td>{{$employee->is_line_manager}}</td>
    <td><img style="height:40px;width:100px" src= "{{url('/images')}}/{{$employee->profile_image}}"></td>
    <td><img style="height:40px;width:100px" src= "{{url('/images')}}/{{$employee->signature}}"></td>
  </tr>
  @endforeach
</table>
@endsection