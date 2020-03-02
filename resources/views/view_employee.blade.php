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
<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
   
        <div class="col-sm-4">
            <h2>Employee list</h2>
        </div>
  

<table class="table table-striped dataTables-example">
   <tr>
    <th>Employee Code</th>    
    <th>Designation</th>    
    <th>Employee Name</th>    
    <th>Employee Email</th>
    <th>Department</th>
    <th>Line Manager</th>
   
    <th>Is Line Manager</th>
    <th>Profile Image</th>
    <th>Signature</th>
    <th>Edit</th>
  </tr>

  @foreach($employee as $employee)
  <tr>
    <td>{{$employee->employee_code}}</td>
    <td>{{$employee->designation}}</td> 
    
     <td>{{$employee->employee_name}}</td>

    <td>{{$employee->employee_email}}</td>
    <td>{{$employee->department}}</td>
    <td>{{$employee->line_manager_name}}</td>
   
    <td>{{$employee->is_line_manager}}</td>
    <td><img class="rounded-circle pp_img" style="height:30px;width:30px" src= "{{url('/images')}}/{{$employee->profile_image}}"></td>
    <td><img style="height:40px;width:100px" src= "{{url('/images')}}/{{$employee->signature}}"></td>
    <td><a href="{{url('/edit')}}/{{$employee->employee_code}}" class="btn btn-warning">Edit</a></td>
  </tr>
  @endforeach
</table>

@endsection
@section('js')
<script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                order: []
            });

        });
    </script>
    @endsection