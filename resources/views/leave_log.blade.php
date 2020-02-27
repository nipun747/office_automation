@extends('layouts.app')
@section('content')

 <style>
table, th, td {
  border: 1px solid black;
   border-collapse:collapse;
   text-align: center;
}
</style> 

<body style="width:90%">
  <h3 style="text-align:center;">Leave Log</h3>
 <table> 
  
 <tr>
  <th width="20%">User Id</th>
  <th  width="20%">Leave Id</th>
  
  <th>Status</th>
  <th>Created</th>
  
 
 </tr>
 @foreach($leave_details as $employees)
 <tr>
  <td>{{$employees->employee_name}}</td>
  <td>{{$employees->leave_id}}</td>
  <td>{{$employees->leave_status}}</td>
  <td >{{$employees->created}}</td>

 </tr>
 

 @endforeach
 </table>
 @endsection