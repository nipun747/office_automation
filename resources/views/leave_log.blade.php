@extends('layouts.app')
@section('content')

 <style>
table, th, td {
   border-collapse:collapse;
   text-align: center;
}
</style> 

  <h3 style="text-align:center;">Leave Log</h3>
 <table class="table table-striped"> 
  
 <tr>
  <th>Leave Category</th>
  <th>Start Date</th>
  <th>End Date</th>
  <th>Applied Days</th>
  <th>Leave Type</th>
  <th>Reason</th>
  <th>Employee Name</th>
  <th>Status</th>
 </tr>
 @foreach($leave_details as $leave)
 <tr>
    <td>{{$leave->leave_category}}</td>
    <td>{{$leave->start_date}}</td>
    <td>{{$leave->end_date}}</td>
    <td>{{$leave->leave_applied}}</td>
    <td>{{$leave->leave_type}}</td>
    <td>{{$leave->reason}}</td>
    <td>{{$leave->employee_name}}</td>
    <td>{{$leave->leave_status}}</td>

 </tr>
 @endforeach
 </table>
 @endsection