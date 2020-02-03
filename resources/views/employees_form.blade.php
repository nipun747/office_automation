@extends('layouts.app')
@section('content')

  
  
 
<form action="{{url('/employee_form_submit')}}" method="post">
  @csrf
    <div class="col-lg-6 offset-lg-3">
  <h4 class="text-center">Leave Management</h4>
</div>
 
  <div class="form-group">
    <label for="employee_code">Employee Code:</label>
    <input type="text" name="employee_code" class="form-control">
  </div>
  <div class="form-group">
    <label for="employee_name">Employee Name:</label>
    <input type="text" name="employee_name" class="form-control">
  </div>
  <div class="form-group">
     <label for="designation">Designation:</label>
    
   <select name="designation" class="form-control">
  @foreach($designations as $designation)
  <option value = "{{$designation->designation_id}}">{{$designation->designation}}</option>
  @endforeach
  </select>
   
  </div>
   <div class="form-group">
    <label for="department">Department:</label>
   
     <select name="department" class="form-control">
  @foreach($departments as $department)

<option value="{{$department->department_id}}">{{$department->department}}</option>
  @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="line_manager">Line Manager:</label>
   
     <select name="line_manager_id" class="form-control">
      @foreach($line_manager as $line_managers)
  <option value="{{$line_managers->employee_id}}">{{$line_managers->employee_name}}</option>
  @endforeach
  
</select>
  </div>
  
   <div class="form-group text-center">
  <button type="submit" class="btn btn-primary">Submit</button>
  </div>

</form>

</div>
@endsection